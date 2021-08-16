<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeUserResource extends JsonResource
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
            'user_id' => $this->user->id,
            'name' => $this->user->name,
            'username' => $this->user->username,
            'email' => $this->user->email,
            'role_id' => $this->user->role_id,
            'profile_photo_url' => $this->user->profile_photo_url,
            'active' => $this->user->active,
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'identity_type' => $this->identity_type,
            'expired_date_identity' => $this->expired_date_identity,
            'no_identity' => $this->no_identity,
            'postal_code' => $this->postal_code,
            'identity_address' => $this->identity_address,
            'residential_address' => $this->residential_address,
            'place_of_birth' => $this->place_of_birth,
            'date_of_birth' => $this->date_of_birth,
            'mobile_phone' => $this->mobile_phone,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'marital_status_id' => $this->marital_status,
            'blood_type_id' => $this->blood_type,
            'religion_id' => $this->religion,
            'education_id' => $this->education,
            'company_id' => $this->company,
            'organization_id' => $this->organization,
            'job_position_id' => $this->job_position,
            'job_level_id' => $this->job_level,
            'employee_status_id' => $this->employee_status,
            'join_date' => $this->join_date,
            'end_date' => $this->end_date,
            'basic_salary' => $this->basic_salary,
            'npwp' => $this->npwp,
            'ptkp_id' => $this->ptkp_id,
            'bank_id' => $this->bank,
            'bank_account' => $this->bank_account,
            'bank_account_holder' => $this->bank_account_holder,
            'bpjs_ketenagakerjaan' => $this->bpjs_ketenagakerjaan,
            'bpjs_kesehatan' => $this->bpjs_kesehatan,
            'bpjs_kesehatan_family' => $this->bpjs_kesehatan_family,
            'type_salary' => $this->type_salary,
            'created_at' => $this->user->created_at,
            'updated_at' => $this->user->updated_at,
        ];
    }
}
