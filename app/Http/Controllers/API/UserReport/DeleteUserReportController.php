<?php

namespace App\Http\Controllers\API\UserReport;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\UserReport;
use Illuminate\Http\Request;

class DeleteUserReportController extends Controller
{
    public function user_report(UserReport $user_report)
    {
        $result = $user_report->delete();
        return ResponseFormatter::success(
            $result,
            'success archive user report data'
        );
    }
}
