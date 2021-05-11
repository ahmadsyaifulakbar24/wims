<?php

namespace App\Http\Controllers\API\Company;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class DeleteCompanyController extends Controller
{
    public function __invoke(Company $company)
    {
        if($company->type == 'center') {
            return ResponseFormatter::error([
                'message' => 'cannot delete this company'
            ], 'delete company failed', 402);
        }

        $company_count = $company->company()->count();
        if($company_count > 0) {
            return ResponseFormatter::error([
                'message' => 'this company already used by emplyee'
            ], 'delete company failed', 400);
        }

        Storage::disk('public')->delete($company->logo_path);
        Storage::disk('public')->delete($company->signature);
        $result = $company->delete();
        return ResponseFormatter::success(
            $result,
            'success delete company'
        );
    }
}
