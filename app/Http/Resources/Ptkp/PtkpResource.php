<?php

namespace App\Http\Resources\Ptkp;

use Illuminate\Http\Resources\Json\JsonResource;

class PtkpResource extends JsonResource
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
            'ptkp' => $this->ptkp,
            'rate' => $this->rate,
            'description' => $this->description,
        ];
    }
}
