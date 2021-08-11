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
            'job_position_name' => ['required', 'string'],
            'parent_id' => [
                'nullable', 
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category', 'job_position');
                }),
            ]
        ]);

        $param_cek = Param::where([['param', $request->job_position_name], ['category', 'job_position']])->count();
        if($param_cek > 0) {
            return ResponseFormatter::error([
                'message' => 'job position name already in input',
            ], 'error create job position', 422);
        }

        $param = Param::create([
            'parent_id' => $request->parent_id,
            'category' => 'job_position',
            'param' => $request->job_position_name,
        ]);

        return ResponseFormatter::success(
            new ParamResource($param),
            'success create Job Position'
        );
    }

    public function update(Request $request, Param $param)
    {
        $this->validate($request, [
            'job_position_name' => ['required', 'string'],
            'parent_id' => [
                'nullable', 
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category', 'job_position');
                }),
            ]
        ]);

        $param_cek = Param::where([['param', $request->job_position_name], ['category', 'job_position']])->where('id', '!=', $param->id)->count();
        if($param_cek > 0) {
            return ResponseFormatter::error([
                'message' => 'job position name already in input',
            ], 'error create job position', 422);
        }

        $input['param'] = $request->job_position_name;
        $input['parent_id'] = $request->parent_id;
        $param->update($input);

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
