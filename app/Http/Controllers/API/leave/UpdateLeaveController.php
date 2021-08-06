<?php

namespace App\Http\Controllers\API\leave;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Leave\LeaveResource;
use App\Models\Employe;
use App\Models\Leave;
use Illuminate\Http\Request;

class UpdateLeaveController extends Controller
{
    public function update(Request $request, Leave $leave)
    {
        $this->validate($request, [
            'total_leave' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'from_date' => ['required', 'date'],
            'till_date' => ['required', 'date'],
        ]);
        
        $input = $request->all();
        $leave->update($input);
        return ResponseFormatter::success(
            new LeaveResource($leave),
            'success update leave data'
        );
    }

    public function approval(Request $request, Leave $leave)
    {
        $this->validate($request, [
            'status' => ['required', 'in:approve,reject'],
        ]);
        
        if($request->status == 'approve') {
            $employe = Employe::find($leave->employee_id);
            $remaining_day_off = $employe->leave - $leave->total_leave;
            $employe->update([ 'leave' => $remaining_day_off ]);
        }

        $leave->update([ 'status' => $request->status ]);
        return ResponseFormatter::success(
            new LeaveResource($leave),
            'success update status leave data'
        );
    }
}
