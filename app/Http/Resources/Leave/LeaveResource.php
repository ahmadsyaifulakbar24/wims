<?php

namespace App\Http\Resources\Leave;

use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResource extends JsonResource
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
            'employee_id' => $this->employee_id,
            'employee_name' => $this->employee->user->name,
            'total_leave' => $this->total_leave,
            'description' => $this->description,
            'from_date' => $this->from_date,
            'till_date' => $this->till_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
