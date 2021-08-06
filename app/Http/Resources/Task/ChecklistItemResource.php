<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Resources\Json\JsonResource;

class ChecklistItemResource extends JsonResource
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
            'checklist_id' => $this->checklist_id,
            'item' => $this->item,
            'start_due_date' => $this->start_due_date,
            'finish_due_date' => $this->finish_due_date,
            'assign' => [
                'id' => (!empty($this->assign)) ? $this->assign->id : null,
                'name' => (!empty($this->assign)) ? $this->assign->name : null,
            ],
        ];
    }
}
