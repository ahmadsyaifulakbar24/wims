<?php

namespace App\Http\Resources\Company;

use App\Http\Resources\City\CityResource;
use App\Http\Resources\MasterParam\MasterParamResource;
use App\Http\Resources\Param\ParamResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'logo_url' => $this->logo_url,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'province' => $this->province,
            'city' => new CityResource($this->city),
            'umr' => $this->umr,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'bpjs' => $this->bpjs,
            'jkk' => new MasterParamResource($this->jkk),
            'npwp' => $this->npwp,
            'taxable_date' => $this->taxable_date,
            'tax_person_name' => $this->tax_person_name,
            'tax_person_npwp' => $this->tax_person_npwp,
            'signature_url' => $this->signature_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
