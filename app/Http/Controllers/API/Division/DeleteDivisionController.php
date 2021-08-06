<?php

namespace App\Http\Controllers\API\Division;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DeleteDivisionController extends Controller
{
    public function __invoke(Division $division)
    {
        $cek_division = $division->board()->count();
        if($cek_division > 0) {
            return ResponseFormatter::error([
                'message' => "can't delete this division because the board already exists"
            ], 'delete division failed', 422);
        }

        $result = $division->delete();
        return ResponseFormatter::success(
            $result,
            'success delete division data'
        );
    }
}
