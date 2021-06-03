<?php

namespace App\Http\Controllers\API\Task;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\Task;
use App\Models\TaskAttachment;

class DeleteTaskController extends Controller
{
    public function archive_task(Task $task)
    {
        $resource = $task->delete();
        return ResponseFormatter::success(
            $resource,
            'success archive task'
        );
    }

    public function task_member(Task $task, $user_id)
    {
        $result = $task->task_members()->detach($user_id);
        return ResponseFormatter::success(
            $result,
            'success delete task member data'
        );
    }

    public function checklist(Checklist $checklist)
    {
        $result = $checklist->delete();
        return ResponseFormatter::success(
            $result,
            'success delete checklist data'
        );
    }

    public function checklist_item(ChecklistItem $checklist_item)
    {
        $result = $checklist_item->delete();
        return ResponseFormatter::success(
            $result,
            'success delete checklist item data'
        );
    }

    public function attachment(TaskAttachment $task_attachment)
    {
        $result = $task_attachment->delete();
        return ResponseFormatter::success(
            $result,
            'success delete task attachment data'
        );
    }
}
