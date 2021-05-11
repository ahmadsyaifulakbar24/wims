<?php

namespace App\Http\Controllers\API\Company;

use App\Helpers\FileHelpers;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Company\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateCompanyController extends Controller
{
    public function __invoke(Request $request, Company $company)
    {
        $this->validate($request, [
            'parent_id' => ['nullable', 'exists:companies,id'],
            'name' => ['required', 'string'],
            'logo' => ['nullable', 'mimes:png,jpg,jpeg', 'max:2048'],
            'address' => ['required', 'string'],
            'postal_code' => ['required', 'numeric'],
            'province_id' => ['required', 'exists:provinces,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'umr' => ['nullable', 'numeric'],
            'phone_number' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'bpjs' => ['required', 'string'],
            'jkk' => ['required', 'string'],
            'npwp' => ['required', 'string'],
            'taxable_date' => ['required', 'date'],
            'tax_person_name' => ['required', 'string'],
            'tax_person_npwp' => ['required', 'string'],
            'signature' => ['nullable', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        if($company) {
            $input['parent_id'] = $request->parent_id;
            $input['name'] = $request->name;
            $input['address'] = $request->address;
            $input['postal_code'] = $request->postal_code;
            $input['province_id'] = $request->province_id;
            $input['city_id'] = $request->city_id;
            $input['umr'] = $request->umr;
            $input['phone_number'] = $request->phone_number;
            $input['email'] = $request->email;
            $input['bpjs'] = $request->bpjs;
            $input['jkk'] = $request->jkk;
            $input['npwp'] = $request->npwp;
            $input['taxable_date'] = $request->taxable_date;
            $input['tax_person_name'] = $request->tax_person_name;
            $input['tax_person_npwp'] = $request->tax_person_npwp;

            if($request->file('logo')) {
                $input['logo_path'] = FileHelpers::upload_file('company', $request->file('logo'), false);
                Storage::disk('public')->delete($company->logo_path);
            }

            if($request->file('signature')) {
                $input['signature'] = FileHelpers::upload_file('company', $request->file('signature'), false);
                Storage::disk('public')->delete($company->signature);
            }

            $company->update($input);
            
            return ResponseFormatter::success(
                new CompanyResource($company),
                'success update company'
            );
        }
    }
}
