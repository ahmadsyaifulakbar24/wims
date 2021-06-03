<?php

namespace App\Http\Controllers\API\Comment;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class UpdateCommentController extends Controller
{
    public function __invoke(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'comment' => ['required', 'string']
        ]);
        
        $comment->update($request->all());
        return ResponseFormatter::success(
            new CommentResource($comment),
            'succes update comment'
        );
    }
}
