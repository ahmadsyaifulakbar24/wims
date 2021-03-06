<?php

namespace App\Http\Controllers\API\Board;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Board\BoadrResource;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateBoardController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'division_id' => [ 'required', 'exists:divisions,id'],
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ]);
        
        $inputBoard = $request->all();
        $board = Board::create($inputBoard);

        $board->board_member()->attach(Auth::user()->id, [ 'role' => 'admin' ]);

        return ResponseFormatter::success(
            new BoadrResource($board),
            'success create board data'
        );
    }
}
