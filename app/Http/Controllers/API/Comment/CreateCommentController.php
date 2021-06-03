<?php

namespace App\Http\Controllers\API\Comment;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task\CommentResource;
use App\Models\Task;
use Illuminate\Http\Request;

class CreateCommentController extends Controller
{
    public function __invoke(Request $request, Task $task)
    {
        $this->validate($request, [
            'comment' => ['required', 'string']
        ]);

        $comment = $task->comment()->create($request->all());
        return ResponseFormatter::success(
            new CommentResource($comment),
            'success create comment'
        );

    }
}
