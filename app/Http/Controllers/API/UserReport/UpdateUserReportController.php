<?php

namespace App\Http\Controllers\API\UserReport;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserReport\UserReportResource;
use App\Models\UserReport;
use Illuminate\Http\Request;

class UpdateUserReportController extends Controller
{
    public function user_report(Request $request, UserReport $user_report)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ]);

        $user_report->update($request->all());
        return ResponseFormatter::success(
            new UserReportResource($user_report),
            'success update user report'
        );
    }
}
