<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        try {
            if(!Auth::attempt(['username' => $request->username, 'password' => $request->password, 'active' => 1])) {
                return ResponseFormatter::error([
                    'message' => 'unauthorization'
                ], 'authentication failed', 500 );
            }
    
            $user = User::where('username', $request->username)->first();
            if(!Hash::check($request->password, $user->password)) {
                throw new \Exception('invalid credentials');        
            }
    
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => new UserResource($user)
            ], 'Authenticated');
            
        } catch (Exception $e) {
            return ResponseFormatter::error([
                'message' => 'someting went wrong',
                'error' => $e->getMessage()
            ], 'Authentication failed', 500);
        }
    }
}
