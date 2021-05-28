<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start_due_date' => $this->start_due_date,
            'finish_due_date' => $this->finish_due_date,
            'members' => TaskMemberResource::collection($this->task_member_many),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
