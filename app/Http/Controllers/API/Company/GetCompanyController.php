<?php

namespace App\Http\Controllers\API\Company;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Company\CompanyResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class GetCompanyController extends Controller
{
    public function fetch(Request $request, $company_id = null)
    {
        $this->validate($request, [
            'type' => ['nullable', 'in:center,branch']
        ]);

        $user = User::find($request->user()->id);
        $company_code = ($user->role_id == 1 || $user->role_id == 100) ? $user->company_code : $user->company_code_parent;
        $message = 'succes get company data';
        $company = Company::where('ref_company_code', $company_code);

        if($company_id) {
            $company = Company::find($company_id);
            if($company_id) {
                return ResponseFormatter::success(
                    new CompanyResource($company),
                    $message
                );
            }
        }
        
        if($request->type) {
            if($request->type == 'center') {
                $company = $company->where('type', 'center')->first();
                return ResponseFormatter::success(
                    new CompanyResource($company),
                    $message
                );
            } else {
                $company->where('type', 'branch');
                return ResponseFormatter::success(
                    CompanyResource::collection($company->get()),
                    $message
                );
            }
        }
        return ResponseFormatter::success(
            $company->get(),
            $message
        );
    }

    public function company_center(Request $request) 
    { 
        $this->validate($request, [
            'limit' => ['nullable', 'numeric']
        ]);

        $limit = $request->input('limit', 15);
        $company = Company::orderBy('id', 'desc')->where('type', 'center')->paginate($limit);

        return CompanyResource::collection($company);
    }
}
