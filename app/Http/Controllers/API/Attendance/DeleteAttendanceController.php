<?php

namespace App\Http\Controllers\API\Attendance;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteAttendanceController extends Controller
{
    public function __invoke(Attendance $attendance)
    {
        ($attendance->login_image) ?: Storage::disk('public')->delete($attendance->login_image);
        ($attendance->home_image) ?: Storage::disk('public')->delete($attendance->home_image);

        $result = $attendance->delete();
        return ResponseFormatter::success(
            $result, 
            'success delete attendance data'
        );
    }
}
