<?php

namespace App\Http\Controllers\API\Param;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Param\ParamResource;
use App\Models\Param;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobPositionController extends Controller
{
    public function fetch()
    {
        $job_position = Param::where('category', 'job_position')->orderBy('id', 'desc')->get();
        return ResponseFormatter::success(
            ParamResource::collection($job_position),
            'success get job position data'
        );
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'job_position_name' => [
                'required', 
                Rule::unique('params', 'param')->where(function($query) {
                    return $query->where('category', 'job_position');
                })
            ],
            'parent_id' => [
                'nullable', 
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category', 'job_position');
                }),
            ]
        ]);

        if($request->parent_id) {
            $param = Param::find($request->parent_id);
            $parent_path = ($param->parent_path) ? $param->parent_path . ',' . $request->parent_id : $request->parent_id;
        }

        $param = Param::create([
            'parent_id' => $request->parent_id,
            'parent_path' => ($request->parent_id) ? $parent_path : null,
            'category' => 'job_position',
            'param' => $request->job_position_name,
        ]);

        return ResponseFormatter::success(
            new ParamResource($param),
            'success create job position'
        );
    }

    public function update(Request $request, Param $param)
    {
        $this->validate($request, [
            'job_position_name' => [
                'required', 
                Rule::unique('params', 'param')->ignore($param->id, 'id')->where(function($query) {
                    return $query->where('category', 'job_position');
                })
            ],
            'parent_id' => [
                'nullable', 
                Rule::exists('params', 'id')->where(function ($query) use ($param) {
                    return $query->where('parent_path', 'not like', '%' . $param->id . '%')->orWhereNull('parent_path')->where('category', 'job_position')->where('id', '!=', $param->id);
                }),
            ]
        ]);

        if($request->parent_id){
            $new_parent = Param::find($request->parent_id);
            $new_parent_path = ($new_parent->parent_path) ? $new_parent->parent_path . '.' . $request->parent_id : $request->parent_id;            
            $input['parent_id'] = $request->parent_id;
            $input['parent_path'] = $new_parent_path;

        } else {
            $input['parent_id'] = null;
            $input['parent_path'] = null;
        }

        $input['param'] = $request->job_position_name;
        $param->update($input);

        $childs = Param::where('parent_path', 'like', '%' . $param->id . '%')->get();
        if($childs) {
            foreach ($childs as $child) {
                $parent_param = Param::find($child->parent_id);
                $new_parent_path = ($parent_param->parent_path) ? $parent_param->parent_path . ',' . $child->parent_id : $child->parent_id;
                $child->update([ 'parent_path' => $new_parent_path ]);
            }
        }

        return ResponseFormatter::success(
            new ParamResource($param),
            'success update job position'
        );
    }

    public function delete(Param $param)
    {
        $cek_param = $param->job_position_employee()->count();
        if($cek_param > 0) {
            return ResponseFormatter::error([
                'message' => 'The job position already used by employee'
            ], 'delete job position data failed', 422);
        }

        $result = $param->delete();
        return ResponseFormatter::success(
            $result,
            'success delete job position data'
        );
    }
}
