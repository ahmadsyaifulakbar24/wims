<?php

namespace App\Http\Controllers\API\Board;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;

class DeleteBoardController extends Controller
{
    public function soft_delete(Board $board)
    {
        $result = $board->delete();
        return ResponseFormatter::success(
            $result,
            'success archived board'
        );
    }
}
