<?php

namespace App\Http\Controllers\API\Division;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Division\DivisionResource;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateDivisionController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'user_id' => [
                'required', 
                Rule::exists('users', 'id')->where(function($query) {
                    $query->whereNull('deleted_at');
                })
            ],
            'pic_id' => [
                'required', 
                Rule::exists('users', 'id')->where(function($query) {
                    $query->whereNull('deleted_at');
                })
            ],
            'name' => ['required', 'string']
        ]);

        $inputDivision = $request->all();
        $division = Division::create($inputDivision);
        return ResponseFormatter::success(
            new DivisionResource($division),
            'success create division data'
        );
    }
}
