<?php

namespace App\Http\Controllers\API\Comment;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task\CommentResource;
use App\Models\Task;
use Illuminate\Http\Request;

class GetCommentController extends Controller
{
    public function __invoke(Task $task)
    {
        return ResponseFormatter::success(
            CommentResource::collection($task->comment),
            'success get comment data'
        );
    }
}
