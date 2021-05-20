<?php

namespace App\Http\Resources\Division;

use Illuminate\Http\Resources\Json\JsonResource;

class DivisionResource extends JsonResource
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
            'user' => [
                'name' => $this->user->name,
                'username' => $this->user->username,
                'email' => $this->user->email,
                'profile_photo_url' => $this->user->profile_photo_url
            ],
            'pic' => [
                'name' => $this->pic->name,
                'username' => $this->pic->username,
                'email' => $this->pic->email,
                'profile_photo_url' => $this->pic->profile_photo_url
            ],
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
