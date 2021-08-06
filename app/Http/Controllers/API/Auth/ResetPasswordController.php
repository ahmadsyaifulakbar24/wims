<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class ResetPasswordController extends Controller
{
    public function __invoke( Request $request )
    {
        $this->validate($request, [
            'user_id' => ['required', 'exists:users,id'],
            'old_password' => ['required', 'string'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:6']
        ]);
        
        $user = User::find($request->user_id);
        if(Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return ResponseFormatter::success(
                new UserResource($user),
                'success update password'
            );
        } else {
            return ResponseFormatter::error([
                'your old password is wrong'
            ], 'error reset password', 402);
        }
    }
}
