<?php

namespace App\Http\Controllers\API\Division;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Division\DivisionResource;
use App\Models\Division;
use App\Models\User;
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

        $user = User::find($request->user()->id);
        $company_code = ($user->role_id == 1 || $user->role_id == 100) ? $user->company_code : $user->company_code_parent;
        $division = Division::query();
        $division->where('ref_company_code', $company_code);
        if($request->pic_id) {
            $division->where('pic_id', $request->pic_id);
        }

        return ResponseFormatter::success(
            DivisionResource::collection($division->get()),
            'success get division data'
        );
    }
}
