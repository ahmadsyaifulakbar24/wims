<?php

namespace App\Http\Controllers\API\Board;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Board\BoardLabelResource;
use App\Models\Board;
use App\Models\BoardLabel;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function fetch(Board $board) 
    {
        return ResponseFormatter::success(
            BoardLabelResource::collection($board->board_label),
            'success get board label'
        );
    }
    
    public function create(Request $request)
    {
        $this->validate($request, [
            'board_id' => ['required', 'exists:boards,id'],
            'name' => ['required', 'string'],
            'color' => ['nullable', 'string'],
        ]);

        $board = Board::find($request->board_id);
        if($board) {
            $inputLabel = $request->all();
            $board_label = $board->board_label()->create($inputLabel);
            return ResponseFormatter::success(
                new BoardLabelResource($board_label),
                'success create board label'
            );
        } else {
            return ResponseFormatter::error([
                'message' => 'board not found'
            ], 'error add label', 404);
        }
    }

    public function update(Request $request, BoardLabel $board_label)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'color' => ['nullable', 'string'],
        ]);

        $board_label->update($request->all());
        return ResponseFormatter::success(
            new BoardLabelResource($board_label),
            'success update board label'
        );
    }

    public function delete(BoardLabel $board_label)
    {
        $result = $board_label->delete();
        return ResponseFormatter::success(
            $result,
            'success delete board lable'
        );
    }
}
