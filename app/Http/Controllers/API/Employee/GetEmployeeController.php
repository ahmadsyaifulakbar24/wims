<?php

namespace App\Http\Controllers\API\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\Employee\EmployeeUserResource;
use App\Models\Employe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GetEmployeeController extends Controller
{
    public function fetch(Request $request, $user_id = null)
    {
        $this->validate($request, [
            'company_id' => [ 'nullable', 'exists:companies,id' ],
            'limit' => ['nullable', 'numeric']
        ]);
        if($user_id) {
            $employee = Employe::where('user_id', $user_id)->first();
            if($employee) {
                return ResponseFormatter::success(
                    new EmployeeUserResource($employee),
                    'success get employee data'
                );
            }
        }

        $user = User::find($request->user()->id);
        $company_code = ($user->role_id == 1 || $user->role_id == 100) ? $user->company_code : $user->company_code_parent;

        $employee = Employe::joinUser()->where('company_code_parent', $company_code);
        $limit = $request->post('limit', 15);
        if($request->company_id) {
            $employee->where('company_id', $request->company_id);
        }

        return ResponseFormatter::success(
            EmployeeUserResource::collection($employee->paginate($limit)),
            'success get employee data'
        );
    }
}
