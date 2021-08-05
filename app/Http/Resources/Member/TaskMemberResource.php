<?php

namespace App\Http\Resources\Member;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskMemberResource extends JsonResource
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
            'id' => $this->pivot->id,
            'task_id' => $this->pivot->task_id,
            'user_id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'email' => $this->email,
            'profile_photo_url' => $this->profile_photo_url,
        ];
    }
}
