<?php

namespace App\Http\Controllers\API\Division;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Division\DivisionResource;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateDivisionController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'pic_id' => [
                'required', 
                Rule::exists('users', 'id')->where(function($query) {
                    $query->whereNull('deleted_at');
                })
            ],
            'name' => ['required', 'string']
        ]);

        $inputDivision = $request->all();
        $user = User::find($request->user()->id);
        $inputDivision['ref_company_code'] = ($user->role_id == '1' || $user->role_id == '100') ? $user->company_code : $user->company_code_parent;
        $division = Division::create($inputDivision);
        return ResponseFormatter::success(
            new DivisionResource($division),
            'success create division data'
        );
    }
}
