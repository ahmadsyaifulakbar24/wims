<?php

namespace App\Http\Resources\MasterParam;

use Illuminate\Http\Resources\Json\JsonResource;

class MasterParamResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'category' => $this->category,
            'name' => $this->name,
        ];
    }
}
