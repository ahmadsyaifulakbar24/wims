<?php

namespace App\Http\Controllers\API\Comment;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class DeleteCommentController extends Controller
{
    public function __invoke(Comment $comment)
    {
        $result = $comment->delete();
        return ResponseFormatter::success(
            $result,
            'success delete comment'
        );
    }
}
