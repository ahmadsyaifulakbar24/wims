<?php

namespace App\Http\Controllers\API\Attendance;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Attendance\AttendanceResource;
use App\Models\Attendance;
use Illuminate\Http\Request;

class GetAttendanceController extends Controller
{
    public function fetch(Request $request, $attendance_id = null)
    {
        $this->validate($request, [
            'login_time' => ['nullable', 'date'],
            'limit' => ['nullable', 'numeric']
        ]);

        if($attendance_id) {
            $attendance = Attendance::find($attendance_id);
            return ResponseFormatter::success(
                new AttendanceResource($attendance),
                'success get attendance data'
            );
        }

        $attendance = Attendance::query();
        $limit = $request->post('limit', 15);
        if($request->login_time) {
            $attendance->whereDate('login_time', $request->login_time);
        }

        return ResponseFormatter::success(
            AttendanceResource::collection($attendance->orderBy('id', 'desc')->paginate($limit)),
            'success get attendance data'
        );
    }
}
