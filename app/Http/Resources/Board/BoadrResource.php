<?php

namespace App\Http\Resources\Board;

use App\Http\Resources\Division\DivisionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BoadrResource extends JsonResource
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
            'division' => new DivisionResource($this->division),
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
