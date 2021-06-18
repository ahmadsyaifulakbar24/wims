<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'company_code' => $this->company_code,
            'company_code_parent' => $this->company_code_parent,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role_id' => $this->user_role,
            'profile_photo_url' => $this->profile_photo_url,
        ];
    }
}
