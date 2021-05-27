<?php

namespace App\Http\Controllers\API\Task;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use App\Models\TaskMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateTaskController extends Controller
{
    public function create_task(Request $request)
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

    public function create_task_member(Request $request, Task $task)
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
}
