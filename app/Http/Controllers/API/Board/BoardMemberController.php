<?php

namespace App\Http\Controllers\API\Board;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Member\MemberResource;
use App\Models\Board;
use App\Models\BoardMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BoardMemberController extends Controller
{
    public function get_member(Board $board)
    {
        return ResponseFormatter::success(
            MemberResource::collection($board->board_member),
            'success get board member data'
        );
    }

    public function add_member(Request $request, Board $board)
    {
        $this->validate($request, [
            'user_id' => [
                'required',
                Rule::exists('users', 'id')->where(function($query) {
                    return $query->where('role_id', 101);
                })
            ]
        ]);
        $cek_member =  BoardMember::where([['board_id', $board->id], ['user_id', $request->user_id]])->count();
        if($cek_member > 0) {
            return ResponseFormatter::error([
                'message' => 'user already exists in this board'
            ], 'error add member', 422);
        }
        $board->board_member()->attach([$request->user_id]);
        return ResponseFormatter::success(
            'true',
            'success add member'
        );
    }

    public function delete_member(BoardMember $boardMember)
    {
        $result = $boardMember->delete();
        return ResponseFormatter::success(
            $result,
            'success delete member'
        );
    }
}
