<?php

namespace App\Http\Controllers\API\Param;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Param\ParamResource;
use App\Models\Param;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function fetch()
    {
        $organization = Param::where('category', 'organization_structure')->orderBy('id', 'desc')->get();
        return ResponseFormatter::success(
            ParamResource::collection($organization),
            'success get organization structure data'
        );
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'organization_name' => ['required', 'string'],
            'parent_id' => [
                'nullable', 
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category', 'organization_structure');
                }),
            ]
        ]);

        $param_cek = Param::where([['param', $request->organization_name], ['category', 'organization_structure']])->count();
        if($param_cek > 0) {
            return ResponseFormatter::error([
                'message' => 'organization name already in input',
            ], 'error create organization structure', 422);
        }
        $param = Param::create([
            'parent_id' => $request->parent_id,
            'category' => 'organization_structure',
            'param' => $request->organization_name,
        ]);

        return ResponseFormatter::success(
            new ParamResource($param),
            'success create organization structure'
        );
    }

    public function update(Request $request, Param $param)
    {
        $this->validate($request, [
            'organization_name' => ['required', 'string'],
            'parent_id' => [
                'nullable', 
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category', 'organization_structure');
                }),
            ]
        ]);

        $param_cek = Param::where([['param', $request->organization_name], ['category', 'organization_structure']])->where('id', '!=', $param->id)->count();
        if($param_cek > 0) {
            return ResponseFormatter::error([
                'message' => 'organization name already in input',
            ], 'error create organization structure', 422);
        }

        $input['param'] = $request->organization_name;
        $input['parent_id'] = $request->parent_id;
        $param->update($input);

        return ResponseFormatter::success(
            new ParamResource($param),
            'success update structure organization'
        );
    }

    public function delete(Param $param)
    {
        $cek_param = $param->organization_employee()->count();
        if($cek_param > 0) {
            return ResponseFormatter::error([
                'message' => 'The organization already used by employee'
            ], 'delete organization data failed', 422);
        }

        $result = $param->delete();
        return ResponseFormatter::success(
            $result,
            'success delete oraganization data'
        );
    }
}
