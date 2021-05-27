<?php

namespace App\Http\Controllers\API\Board;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Board\BoadrResource;
use App\Models\Board;
use Illuminate\Http\Request;

class GetBoardController extends Controller
{
    public function fetch(Request $request, $board_id = null)
    {
        $this->validate($request, [
            'division_id' => ['nullable', 'exists:divisions,id'],
            'limit' => ['nullable', 'numeric']
        ]);

        if($board_id) {
            $board = Board::find($board_id);
            return ResponseFormatter::success(
                new BoadrResource($board),
                'success get board data'
            );
        }

        $limit = $request->post('limit', 15);
        $board = Board::query();
        if($request->division_id) {
            $board->where('division_id', $request->division_id);
        }

        return ResponseFormatter::success(
            BoadrResource::collection($board->paginate($limit)),
            'success get board data'
        );
    }
}
