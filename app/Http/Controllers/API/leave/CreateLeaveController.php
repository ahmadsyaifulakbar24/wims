<?php

namespace App\Http\Controllers\API\leave;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Leave\LeaveResource;
use App\Http\Resources\Task\CommentResource;
use App\Models\Comment;
use App\Models\Leave;
use Illuminate\Http\Request;

class CreateLeaveController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'employee_id' => ['required', 'exists:employes,id'],
            'total_leave' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'from_date' => ['required', 'date'],
            'till_date' => ['required', 'date'],
        ]);

        $input = $request->all();
        $input['status'] = 'pending';
        $leave = Leave::create($input);
        return ResponseFormatter::success(
            new LeaveResource($leave),
            'success create leave data'
        );
    }

    public function comment(Request $request, Leave $leave)
    {
        $this->validate($request, [
            'comment' => ['required', 'string']
        ]);

        $comment = $leave->comment()->create($request->all());
        return ResponseFormatter::success(
            new CommentResource($comment),
            'success create comment'
        );
    }
}
