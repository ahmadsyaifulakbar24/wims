<?php

namespace App\Http\Controllers\API\Task;

use App\Helpers\FileHelpers;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task\ChecklistItemResource;
use App\Http\Resources\Task\ChecklistResource;
use App\Http\Resources\Task\TaskAttachmentResource;
use App\Http\Resources\Task\TaskLabelResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\Checklist;
use App\Models\Task;
use App\Models\Storage as StorageModel;
use App\Models\TaskMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateTaskController extends Controller
{
    public function task(Request $request)
    {
        $this->validate($request, [
            'board_id' => ['required', 'exists:boards,id'],
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'start_due_date' => ['nullable', 'date'],
            'finish_due_date' => ['nullable', 'date'],
        ]);

        $inputTask = $request->all();
        $task = Task::create($inputTask);
        return ResponseFormatter::success(
            new TaskResource($task),
            'success create task'
        );
    }

    public function task_member(Request $request, Task $task)
    {
        $this->validate($request, [
            'user_id' => [
                'required',
                Rule::exists('board_members', 'user_id')->where(function ($query) use ($task) {
                    return $query->where('board_id', $task->board_id);
                })
            ]
        ]);
        $cek_member = TaskMember::where([['task_id', $task->id], ['user_id', $request->user_id]])->count();
        if($cek_member > 0) {
            return ResponseFormatter::error([
                'member already exists'
            ], 'add member failed', 422);
        }
        $task->task_members()->attach(['user_id' => $request->user_id]);
        return ResponseFormatter::success(
            'true',
            'success add member'
        );
    }

    public function checklist(Request $request, Task $task)
    {
        $this->validate($request, [
            'title' => ['required', 'string']
        ]);

        $task->checklist()->create($request->all());
        return ResponseFormatter::success(
            ChecklistResource::collection($task->checklist),
            'success create checklist task'
        );
    }

    public function checklist_item(Request $request, Checklist $checklist)
    {
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
        $checklist->checklist_item()->create($input);
        return ResponseFormatter::success(
            ChecklistItemResource::collection($checklist->checklist_item),
            'success create checklist_item'
        );
    }

    public function attachment(Request $request, Task $task)
    {
        $this->validate($request, [
            'attachment' => ['required'],
            'name' => ['nullable', 'string'],
        ]);

        $attachment = $request->attachment;
        if($request->file('attachment')) {
            $name = $attachment->getClientOriginalName();
            $path = FileHelpers::upload_file('file_manager', $attachment);
            $inputAttachment['file_url'] = $path;
            $inputAttachment['name'] = $name;
            $inputAttachment['type'] = 'file';
            StorageModel::create($inputAttachment);
        } else {
            $inputAttachment['file_url'] = $attachment;
            $inputAttachment['name'] = (!empty($request->name)) ? $request->name : $request->file_url;
            $inputAttachment['type'] = 'url';
        }
        $attachment = $task->attachment()->create($inputAttachment);
        return ResponseFormatter::success(
            new TaskAttachmentResource($attachment),
            'success attachment data'
        );
    }

    public function label(Request $request, Task $task)
    {
        $this->validate($request, [
            'board_label_id' => [
                'required',
                Rule::exists('board_labels', 'id')->where(function($query) use ($task){
                    return $query->where('board_id', $task->board_id);
                })
            ]
        ]);

        if($task->label()->where('board_label_id', $request->board_label_id)->count() >= 1) {
            return ResponseFormatter::error([
                'label already exists'
            ], 'error create label', 422);
        }

        $label = $task->label()->create($request->all());
        return ResponseFormatter::success(
            new TaskLabelResource($label),
            'success create task label'
        );
    }
}
