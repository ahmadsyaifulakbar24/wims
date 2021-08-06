<?php

namespace App\Http\Controllers\API\Comment;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task\CommentResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateCommentController extends Controller
{
    public function __invoke(Request $request, Task $task)
    {
        $this->validate($request, [
            'comment' => ['required', 'string'],
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $comment = $task->comment()->create($input);
        return ResponseFormatter::success(
            new CommentResource($comment),
            'success create comment'
        );

    }
}
