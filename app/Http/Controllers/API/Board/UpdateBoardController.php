<?php

namespace App\Http\Controllers\API\Board;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Board\BoadrResource;
use App\Models\Board;
use Illuminate\Http\Request;

class UpdateBoardController extends Controller
{
    public function __invoke(Request $request, Board $board)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ]);
        
        $inputBoard = $request->all();
        $board->update($inputBoard);
        return ResponseFormatter::success(
            new BoadrResource($board),
            'success get board data'
        );
    }
}
