<?php

namespace App\Http\Resources\Task;

use App\Models\TaskMember;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $task_member = TaskMember::where('task_id', $this->id)->get();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start_due_date' => $this->start_due_date,
            'finish_due_date' => $this->finish_due_date,
            'members' => TaskMemberResource::collection($task_member),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
