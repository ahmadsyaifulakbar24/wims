<?php

namespace App\Http\Controllers\API\DIvision;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Division\DivisionResource;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GetDivisionController extends Controller
{
    public function fetch(Request $request, $division_id = null)
    {
        $this->validate($request, [
            'pic_id' => [
                'nullable', 
                Rule::exists('users', 'id')->where(function($query) {
                    $query->whereNull('deleted_at');
                })
            ], 
        ]);

        if($division_id) {
            $division = Division::find($division_id);
            if($division) {
                return ResponseFormatter::success(
                    new DivisionResource($division),
                    'success get division data'
                );
            }
        }

        $division = Division::query();
        if($request->pic_id) {
            $division->where('pic_id', $request->pic_id);
        }

        return ResponseFormatter::success(
            DivisionResource::collection($division->get()),
            'success get division data'
        );
    }
}
