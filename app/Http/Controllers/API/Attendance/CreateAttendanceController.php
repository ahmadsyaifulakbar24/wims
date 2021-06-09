<?php

namespace App\Http\Controllers\API\Attendance;

use App\Helpers\FileHelpers;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Attendance\AttendanceResource;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CreateAttendanceController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'employee_id' => ['required', 'exists:employes,id'],
            'login_image' => ['required', 'mimes:jpeg,jpg,png,gif'],
            'login_time' => ['required'],
            'login_latitude' => ['required', 'string'],
            'login_longitude' => ['required', 'string'],
            'login_description' => ['nullable', 'string']
        ]);

        
        $date = Carbon::parse($request->login_time)->format('Y-m-d');
        $cek = Attendance::where('employee_id', $request->employee_id)->whereDate('login_time', $date)->count();
        if($cek > 0) {
            return ResponseFormatter::error(
                'absence data already exists'
            );
        }
        $input = $request->all();
        $image = $request->file('login_image');
        if($image) {
            $ext = $image->getClientOriginalExtension();
            $image_name = Str::random(15).".".$ext;
            $input['login_image'] = FileHelpers::upload_image_resize($image, 'attendance', $image_name);
        }

        $attendance = Attendance::create($input);
        return ResponseFormatter::success(
            new AttendanceResource($attendance),
            'success create attendance'
        );
    }
}
