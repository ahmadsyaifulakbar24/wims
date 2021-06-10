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

class CreateAttendanceController extends Controller
{
    public function attendance_login(Request $request)
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
            'success create sign-in attendance'
        );
    }

    public function attendance_home(Request $request, Attendance $attendance) {
        $this->validate($request, [
            'home_image' => ['required', 'mimes:jpeg,jpg,png,gif'],
            'home_time' => ['required'],
            'home_latitude' => ['required', 'string'],
            'home_longitude' => ['required', 'string'],
            'home_description' => ['nullable', 'string']
        ]);

        if($attendance->home_time) {
            return ResponseFormatter::error([
                'out attendance data already exists'
            ], 'error out attendance', 422);
        }

        $image = $request->file('home_image');
        if($image) {
            $ext = $image->getClientOriginalExtension();
            $image_name = Str::random(15).".".$ext;
            $input['home_image'] = FileHelpers::upload_image_resize($image, 'attendance', $image_name);
        }
        $input['home_time'] = $request->home_time;
        $input['home_latitude'] = $request->home_latitude;
        $input['home_longitude'] = $request->home_longitude;
        $input['home_description'] = $request->home_description;

        $attendance->update($input);
        return ResponseFormatter::success(
            new AttendanceResource($attendance),
            'success create out attendance'
        );
    }
}
