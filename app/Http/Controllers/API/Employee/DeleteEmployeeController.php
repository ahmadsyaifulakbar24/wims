<?php

namespace App\Http\Controllers\API\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteEmployeeController extends Controller
{
    public function __invoke(User $user)
    {
        $result = $user->delete();
        return ResponseFormatter::success(
            $result,
            'success delete employee data'
        );
    }
}
