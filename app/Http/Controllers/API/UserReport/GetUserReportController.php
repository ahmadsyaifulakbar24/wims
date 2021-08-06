<?php

namespace App\Http\Controllers\API\UserReport;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task\CommentResource;
use App\Http\Resources\Task\TaskAttachmentResource;
use App\Http\Resources\UserReport\UserReportResource;
use App\Models\UserReport;
use Illuminate\Http\Request;

class GetUserReportController extends Controller
{
    public function user_report(Request $request, $user_report_id = null)
    {
        $this->validate($request, [
            'user_id' => ['nullable', 'exists:users,id']
        ]);

        if($user_report_id) {
            $user_report = UserReport::find($user_report_id);
            return ResponseFormatter::success(
                new UserReportResource($user_report),
                'success get user report data'
            );
        }

        $user_report = UserReport::query();
        if($request->user_id) {
            $user_report->where('user_id', $request->user_id);
        };
        
        return ResponseFormatter::success(
            UserReportResource::collection($user_report->get()),
            'success get user report data'
        );
    }

    public function attachment(UserReport $user_report)
    {
        return ResponseFormatter::success(
            TaskAttachmentResource::collection($user_report->attachment),
            'success get user report data'
        );
    }

    public function comment(UserReport $user_report)
    {
        return ResponseFormatter::success(
            CommentResource::collection($user_report->comment),
            'success get comment data'
        );
    }
}
