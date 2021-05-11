<?php

namespace App\Http\Controllers\API\Company;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Company\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class GetCompanyController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'type' => ['required', 'in:center,branch']
        ]);
        $message = 'succes get company data';
        if($request->type == 'center') {
            $company = Company::where('type', 'center')->first();
            return ResponseFormatter::success(
                new CompanyResource($company),
                $message
            );
        } else {
            $company = Company::query();
            $company->where('type', 'branch');
            return ResponseFormatter::success(
                $company->get(),
                $message
            );
        }
    }
}
