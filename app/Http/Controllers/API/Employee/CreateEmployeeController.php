<?php

namespace App\Http\Controllers\API\Employee;

use App\Helpers\FileHelpers;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CreateEmployeeController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'employee_id' => ['required', 'string', 'unique:employes,employee_id'],
            'first_name' => ['required', 'string'],
            'last_name' => ['nullable', 'string'],
            'username' => ['required', 'string', 'unique:users,username'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required', 'min:8'],
            'email' => ['nullable', 'email'],
            'profile_photo' => ['nullable', 'mimes:jpeg,jpg,png,gif'],
            'identity_type' => ['nullable', 'in:ktp,passport'],
            'expired_date_identity' => ['nullable', 'date'],
            'no_identity' => ['nullable', 'numeric'],
            'postal_code' => ['nullable', 'numeric'],
            'identity_address' => ['nullable', 'string'],
            'residential_address' => ['nullable', 'string'],
            'place_of_birth' => ['nullable', 'string'],
            'date_of_birth' => ['nullable', 'date'],
            'mobile_phone' => ['nullable', 'numeric'],
            'phone' => ['nullable', 'numeric'],
            'gender' => ['required', 'in:male,female'],
            'marital_status_id' => [
                'required', 
                Rule::exists('master_params', 'id')->where(function ($query) {
                    return $query->where('category', 'marital_status');
                })
            ],
            'blood_type_id' => [
                'nullable', 
                Rule::exists('master_params', 'id')->where(function ($query) {
                    return $query->where('category', 'blood_type');
                })
            ],
            'religion_id' => [
                'required', 
                Rule::exists('master_params', 'id')->where(function ($query) {
                    return $query->where('category', 'religion');
                })
            ],
            'education_id' => [
                'nullable', 
                Rule::exists('master_params', 'id')->where(function ($query) {
                    return $query->where('category', 'education');
                })
            ],
            'company_id' => ['required', 'exists:companies,id'],
            'organization_id' => [
                'required', 
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category', 'organization_structure');
                })
            ],
            'job_position_id' => [
                'required', 
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category', 'job_position');
                })
            ],
            'job_level_id' => [
                'required', 
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category', 'job_level');
                })
            ],
            'employee_status_id' => [
                'required', 
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category', 'employee_status');
                })
            ],
            'join_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'basic_salary' => ['required', 'numeric'],
            'npwp' => ['nullable', 'string'],
            'ptkp_id' => [ 'nullable', 'exists:ptkp,id'],
            'bank_id' => ['nullable', 'exists:banks,id'],
            'bank_account' => ['nullable', 'numeric'],
            'bank_account_holder' => ['nullable', 'string'],
            'bpjs_ketenagakerjaan' => ['nullable', 'string'],
            'bpjs_kesehatan' => ['nullable', 'string'],
            'bpjs_kesehatan_family' => ['nullable', 'numeric'],
            'type_salary' => ['required', 'in:monthly,daily'],
        ]);

        $parent_user = User::find($request->user()->id);

        $inputUser['company_code_parent'] = $parent_user->company_code;
        $inputUser['name'] = $request->first_name.' '.$request->last_name;
        $inputUser['username'] = $request->username;
        $inputUser['email'] = $request->email;
        $inputUser['password'] =  Hash::make($request->password);
        $inputUser['role_id'] = 101;
        $inputUser['active'] = 1;
        if($request->file('profile_photo')) {
            $file_name = FileHelpers::file_name('profile_photo', $request->file('profile_photo'));
            $profile_photo_path = FileHelpers::upload_image_resize($request->file('profile_photo'), 'profile_photo', $file_name);
            $inputUser['profile_photo_path'] = $profile_photo_path;
        }

        $result = DB::transaction(function () use ($request, $inputUser) {
            $user = User::create($inputUser);
            $inputEmployee = $request->all();
            $user->employee()->create($inputEmployee);
            return ResponseFormatter::success(
                new EmployeeResource($user),
                'success create employee data'
            );
        });
        return $result;
    }
}
