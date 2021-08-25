<?php

namespace App\Http\Controllers\API\Company;

use App\Helpers\FileHelpers;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Company\CompanyResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateCompanyController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'parent_id' => ['required', 'exists:companies,id'],
            'name' => ['required', 'string'],
            'logo' => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
            'address' => ['required', 'string'],
            'postal_code' => ['required', 'numeric'],
            'province_id' => ['required', 'exists:provinces,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'umr' => ['nullable', 'numeric'],
            'phone_number' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'bpjs' => ['required', 'string'],
            'jkk_id' => [
                'required',
                Rule::exists('master_params', 'id')->where( function($query) {
                    return $query->where('category', 'jkk');
                })
            ],
            'npwp' => ['required', 'string'],
            'taxable_date' => ['required', 'date'],
            'tax_person_name' => ['required', 'string'],
            'tax_person_npwp' => ['required', 'string'],
            'signature' => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);
        
        $input = $request->all();
        if($request->file('logo')) {
            $input['logo_path'] = FileHelpers::upload_file('company', $request->file('logo'), false);
        }

        if($request->file('signature')) {
            $input['signature'] = FileHelpers::upload_file('company', $request->file('signature'), false);
        }

        $user = User::find($request->user()->id);
        $input['ref_company_code'] = ($user->role_id == '1' || $user->role_id == '100') ? $user->company_code : $user->company_code_parent;
        $input['type'] = 'branch';
        $company = Company::create($input);
        
        return ResponseFormatter::success(
            new CompanyResource($company),
            'success create branch company'
        );
    }
}
