<?php

namespace App\Http\Controllers\API\User;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateUserController extends Controller
{
    public function admin(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'username' => ['required', 'unique:users,username'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'numeric'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required', 'min:8']
        ]);

        $super_admin = User::find($request->user()->id);
        $userData['company_code_parent'] = $super_admin->company_code;
        $userData['name'] = $request->name;
        $userData['username'] = $request->username;
        $userData['email'] = $request->email;
        $userData['phone_number'] = $request->phone_number;
        $userData['password'] = Hash::make($request->password);
        $userData['role_id'] = 100;
        $userData['active'] = 1;
        $user = User::create($userData);

        return ResponseFormatter::success(
            new UserResource($user),
            'success create admin user'
        );
    }
}
