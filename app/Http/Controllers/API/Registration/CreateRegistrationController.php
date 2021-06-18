<?php

namespace App\Http\Controllers\API\Registration;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CreateRegistrationController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'unique:users,username'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'company_name' => ['required', 'string'],
            'employee_reach_id' => [
                'required',
                Rule::exists('master_params', 'id')->where(function($query) {
                    return $query->where('category', 'employee_reach');
                })
            ],
            'phone_number' => ['required', 'numeric'], 
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required', 'min:8']
        ]);

        $user = User::create([
            'company_code' => rand(1, 999999),
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role_id' => 1,
            'active' => true,
        ]);

        $user->company()->create([
           'employee_reach_id' => $request->employee_reach_id,
           'name' => $request->company_name,
           'phone_number' => $request->phone_number,
           'email' => $request->email,
           'type' => 'center',
        ]);

        return ResponseFormatter::success(
            new UserResource($user),
            'success register company'
        );
    }
}
