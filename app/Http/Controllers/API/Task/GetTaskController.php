<?php

namespace App\Http\Controllers\API\Task;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Member\MemberResource;
use App\Http\Resources\Task\ChecklistResource;
use App\Http\Resources\Task\TaskAttachmentResource;
use App\Http\Resources\Task\TaskDetailResource;
use App\Http\Resources\Task\TaskLabelResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class GetTaskController extends Controller
{
    public function task(Request $request, $task_id = null)
    {
        $this->validate($request, [
            'board_id' => ['required', 'exists:boards,id'],
            'user_id' => ['nullable', 'exists:users,id']
        ]);
        $success_message = 'success get task data';
        
        if($task_id) {
            $task = Task::find($task_id);
            return ResponseFormatter::success(
                new TaskDetailResource($task),
                $success_message
            );
        }

        if($request->user_id){
            $task = Task::taskJoinTaskMember()->where([ ['user_id', $request->user_id], ['board_id', $request->board_id] ])->get();
            return ResponseFormatter::success(
                TaskResource::collection($task),
                $success_message
            );
        }

        $task = Task::where('board_id', $request->board_id)->get();
        return ResponseFormatter::success(
            TaskResource::collection($task),
            $success_message
        );
    }

    public function task_member(Task $task)
    {
        return ResponseFormatter::success(
            MemberResource::collection($task->task_members),
            'success get Task Member'
        );
    }

    public function checklist(Task $task)
    {
        return ResponseFormatter::success(
            ChecklistResource::collection($task->checklist),
            'success get checklist data'
        );
    }

    public function attachment(Task $task)
    {
        return ResponseFormatter::success(
            TaskAttachmentResource::collection($task->attachment),
            'success get task attachment'
        );
    }

    public function label(Task $task)
    {
        return ResponseFormatter::success(
            TaskLabelResource::collection($task->label),
            'success get task label data'
        );
    }
}
