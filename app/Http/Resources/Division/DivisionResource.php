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
            'pic' => [
                'id' => $this->pic->id,
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
