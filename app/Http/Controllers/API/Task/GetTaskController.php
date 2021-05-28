<?php

namespace App\Http\Controllers\API\Task;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task\TaskDetailResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class GetTaskController extends Controller
{
    public function task(Request $request, $task_id = null)
    {
        $this->validate($request, [
            'board_id' => ['required', 'exists:boards,id'],
        ]);
        $success_message = 'success get task data';
        if($task_id) {
            $task = Task::find($task_id);
            return ResponseFormatter::success(
                new TaskDetailResource($task),
                $success_message
            );
        }

        $task = Task::where('board_id', $request->board_id)->get();
        return ResponseFormatter::success(
            TaskResource::collection($task),
            $success_message
        );
    }
}
