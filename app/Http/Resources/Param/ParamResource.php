<?php

namespace App\Http\Resources\Param;

use Illuminate\Http\Resources\Json\JsonResource;

class ParamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parent = ($this->parent_id) ? [ 'id' => $this->parent->id, 'param' => $this->parent->param ] : null;
        return [
            'id' => $this->id,
            'parent' => $parent,
            'param' => $this->param,
            'option' => $this->option
        ];
    }
}
