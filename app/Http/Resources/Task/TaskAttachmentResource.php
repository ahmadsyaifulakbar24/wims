<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskAttachmentResource extends JsonResource
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
            'task_id' => $this->task_id,
            'name' => $this->name,
            'file_url' => $this->file_url,
            'type' => $this->type,
        ];
    }
}
