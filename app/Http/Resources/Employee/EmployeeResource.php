<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'profile_photo_url' => $this->profile_photo_url,
            'active' => $this->active,
            'employee_id' => $this->employee->employee_id,
            'identity_type' => $this->employee->identity_type,
            'expired_date_identity' => $this->employee->expired_date_identity,
            'no_identity' => $this->employee->no_identity,
            'postal_code' => $this->employee->postal_code,
            'identity_address' => $this->employee->identity_address,
            'residential_address' => $this->employee->residential_address,
            'place_of_birth' => $this->employee->place_of_birth,
            'date_of_birth' => $this->employee->date_of_birth,
            'mobile_phone' => $this->employee->mobile_phone,
            'phone' => $this->employee->phone,
            'gender' => $this->employee->gender,
            'marital_status_id' => $this->employee->marital_status,
            'blood_type_id' => $this->employee->blood_type,
            'religion_id' => $this->employee->religion,
            'education_id' => $this->employee->education,
            'company_id' => $this->employee->company,
            'organization_id' => $this->employee->organization,
            'job_position_id' => $this->employee->job_position,
            'job_level_id' => $this->employee->job_level,
            'employee_status_id' => $this->employee->employee_status,
            'join_date' => $this->employee->join_date,
            'end_date' => $this->employee->end_date,
            'basic_salary' => $this->employee->basic_salary,
            'npwp' => $this->employee->npwp,
            'ptkp_id' => $this->employee->ptkp_id,
            'bank_id' => $this->employee->bank,
            'bank_account' => $this->employee->bank_account,
            'bank_account_holder' => $this->employee->bank_account_holder,
            'bpjs_ketenagakerjaan' => $this->employee->bpjs_ketenagakerjaan,
            'bpjs_kesehatan' => $this->employee->bpjs_kesehatan,
            'bpjs_kesehatan_family' => $this->employee->bpjs_kesehatan_family,
            'type_salary' => $this->employee->type_salary,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
