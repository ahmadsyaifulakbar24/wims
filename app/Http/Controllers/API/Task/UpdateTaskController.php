<?php

namespace App\Http\Controllers\API\Task;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task\ChecklistItemResource;
use App\Http\Resources\Task\ChecklistResource;
use App\Http\Resources\Task\TaskAttachmentResource;
use App\Http\Resources\Task\TaskDetailResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\Task;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateTaskController extends Controller
{
    public function task(Request $request, Task $task)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'start_due_date' => ['nullable', 'date'],
            'finish_due_date' => ['nullable', 'date'],
        ]);

        $inputTask = $request->all();
        $task->update($inputTask);
        return ResponseFormatter::success(
            new TaskDetailResource($task),
            'success update task'
        );
    }

    public function checklist(Request $request, Checklist $checklist)
    {
        $this->validate($request, [
            'title' => ['required', 'string']
        ]);
        $checklist->update($request->all());
        return ResponseFormatter::success(
            new ChecklistResource($checklist),
            'success update checklist task'
        );
    }

    public function checklist_item(Request $request, ChecklistItem $checklist_item)
    {
        $checklist = Checklist::find($checklist_item->checklist_id);
        $this->validate($request, [
            'item' => ['required', 'string'],
            'start_due_date' => ['nullable', 'date'],
            'finish_due_date' => ['nullable', 'date'],
            'assign_id' => [
                'nullable', 
                Rule::exists('task_members', 'user_id')->where(function ($query) use ($checklist){
                    return $query->where('task_id', $checklist->task_id);
                }),
            ]
        ]);

        $input = $request->all();
        $checklist_item->update($input);
        return ResponseFormatter::success(
            new ChecklistItemResource($checklist_item),
            'success create checklist_item'
        );
    }

    public function attachment(Request $request, TaskAttachment $task_attachment)
    {
        if($task_attachment->type == 'file') {
            $validate = [
                'name' => ['required', 'string']
            ];
        } else {
            $validate = [
                'name' => ['required', 'string'],
                'file_url' => ['required', 'url']
            ];
        }
        $this->validate($request, $validate);

        if($task_attachment->type == 'file') {
            $input = [ 'name' => $request->name ];
        } else {
            $input = [ 'name' => $request->name, 'file_url' => $request->file_url ];
        }
        $task_attachment->update($input);
        
        return ResponseFormatter::success(
            new TaskAttachmentResource($task_attachment),
            'success update task attachment'
        );
    }
}
