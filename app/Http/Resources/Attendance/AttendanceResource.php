<?php

namespace App\Http\Resources\Attendance;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
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

            // login time
            'login_image' => $this->login_image,
            'login_time' => $this->login_time,
            'login_latitude' => $this->login_latitude,
            'login_longitude' => $this->login_longitude,
            'login_description' => $this->login_description,

            // home_time
            'home_image' => $this->home_image,
            'home_time' => $this->home_time,
            'home_latitude' => $this->home_latitude,
            'home_longitude' => $this->home_longitude,
            'home_description' => $this->home_description,
        ];
    }
}
