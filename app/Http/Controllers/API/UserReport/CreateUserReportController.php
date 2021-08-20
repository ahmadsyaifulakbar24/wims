<?php

namespace App\Http\Controllers\API\UserReport;

use App\Helpers\FileHelpers;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task\CommentResource;
use App\Http\Resources\Task\TaskAttachmentResource;
use App\Http\Resources\UserReport\UserReportResource;
use App\Models\UserReport;
use Illuminate\Http\Request;
use App\Models\Storage as StorageModel;
use Illuminate\Support\Facades\Auth;

class CreateUserReportController extends Controller
{
    public function user_report(Request $request)
    {
        $this->validate($request, [
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ]);

        $user_report = UserReport::create($request->all());
        return ResponseFormatter::success(
            new UserReportResource($user_report),
            'success create user report'
        );
    }

    public function attachment(Request $request, UserReport $user_report)
    {
        $this->validate($request, [
            'attachment' => ['required'],
            'name' => ['nullable', 'string'],
        ]);

        $attachment = $request->attachment;
        if($request->file('attachment')) {
            $name = $attachment->getClientOriginalName();
            $path = FileHelpers::upload_file('file_manager', $attachment);
            $inputAttachment['file_url'] = $path;
            $inputAttachment['name'] = $name;
            $inputAttachment['type'] = 'file';
            StorageModel::create($inputAttachment);
        } else {
            $inputAttachment['file_url'] = $attachment;
            $inputAttachment['name'] = (!empty($request->name)) ? $request->name : $request->file_url;
            $inputAttachment['type'] = 'url';
        }
        $attachment = $user_report->attachment()->create($inputAttachment);
        return ResponseFormatter::success(
            new TaskAttachmentResource($attachment),
            'success attachment data'
        );
    }

    public function comment(Request $request, UserReport $user_report)
    {
        $this->validate($request, [
            'comment' => ['required', 'string']
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $comment = $user_report->comment()->create($input);
        return ResponseFormatter::success(
            new CommentResource($comment),
            'success create comment'
        );
    }
}
