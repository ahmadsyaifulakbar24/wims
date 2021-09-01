<?php

namespace App\Http\Controllers\API\leave;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Leave\LeaveResource;
use App\Http\Resources\Task\CommentResource;
use App\Models\Leave;
use Illuminate\Http\Request;

class GetLeaveController extends Controller
{
    public function fetch(Request $request, $leave_id = null)
    {
        $this->validate($request, [
            'limit' => ['nullable', 'numeric'],
            'employee_id' => ['nullable', 'exists:employes,id']
        ]);
        $limit = $request->post('limit', 15);
        if($leave_id) {
            $leave = Leave::find($leave_id);
            return ResponseFormatter::success(
                new LeaveResource($leave),
                'success get leave data'
            );
        }

        $leave = Leave::query();
        if($request->employee_id) {
            $leave->where('employee_id', $request->employee_id);
        }

        return ResponseFormatter::success(
            LeaveResource::collection($leave->orderBy('id', 'desc')->paginate($limit)),
            'success get leave data'
        );
    }

    public function comment(Leave $leave)
    {
        return ResponseFormatter::success(
            CommentResource::collection($leave->comment),
            'success get comment'
        );
    }
}
