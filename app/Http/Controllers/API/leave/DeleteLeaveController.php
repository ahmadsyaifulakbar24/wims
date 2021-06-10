<?php

namespace App\Http\Controllers\API\leave;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;

class DeleteLeaveController extends Controller
{
    public function __invoke(Leave $leave)
    {
        $result = $leave->delete();
        return ResponseFormatter::success(
            $result,
            'success delete leave data'
        );
    }
}
