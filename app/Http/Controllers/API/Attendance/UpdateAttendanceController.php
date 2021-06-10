<?php

namespace App\Http\Controllers\API\attendance;

use App\Helpers\FileHelpers;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Attendance\AttendanceResource;
use App\Models\Attendance;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdateAttendanceController extends Controller
{
    public function __invoke(Request $request, Attendance $attendance)
    {
        $this->validate($request, [
            'login_image' => ['nullable', 'mimes:jpeg,jpg,png,gif'],
            'login_time' => ['required'],
            'login_latitude' => ['required', 'string'],
            'login_longitude' => ['required', 'string'],
            'login_description' => ['nullable', 'string'],

            'home_image' => ['nullable', 'mimes:jpeg,jpg,png,gif'],
            'home_time' => [
                Rule::requiredIf(!empty($attendance->home_time))
            ],
            'home_latitude' => [
                Rule::requiredIf(!empty($attendance->home_latitude)),
                'string'
            ],
            'home_longitude' => [
                Rule::requiredIf(!empty($attendance->home_longitude )),
                'string'
            ],
            'home_description' => ['nullable', 'string']
        ]);

        $input = $request->all();
        $login_image = $request->login_image;
        if($login_image) {
            $ext = $login_image->getClientOriginalExtension();
            $image_name = Str::random(15).".".$ext;
            $input['login_image'] = FileHelpers::upload_image_resize($login_image, 'attendance', $image_name);
            Storage::disk('public')->delete($attendance->login_image);
        }

        $home_image = $request->file('home_image');
        if($home_image) {
            $ext = $home_image->getClientOriginalExtension();
            $image_name = Str::random(15).".".$ext;
            $input['home_image'] = FileHelpers::upload_image_resize($home_image, 'attendance', $image_name);
            Storage::disk('public')->delete($attendance->home_image);
        }

        $attendance->update($input);
        return ResponseFormatter::success(
            new AttendanceResource($attendance),
            'success update attendance data'
        );
    }
}
