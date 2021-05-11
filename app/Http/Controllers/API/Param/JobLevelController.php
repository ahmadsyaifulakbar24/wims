<?php

namespace App\Http\Controllers\API\Param;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Param\ParamResource;
use App\Models\Param;
use Illuminate\Http\Request;

class JobLevelController extends Controller
{
    public function fetch()
    {
        $job_level = Param::where('category', 'job_level')->orderBy('param', 'ASC')->get();
        return ResponseFormatter::success(
            ParamResource::collection($job_level),
            'success get job level data'
        );
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'job_level_name' => ['required', 'string']
        ]);

        $param_cek = Param::where([['param', $request->job_level_name], ['category', 'job_level']])->count();
        if($param_cek > 0) {
            return ResponseFormatter::error([
                'message' => 'job level name already in input',
            ], 'error create job level name', 422);
        }

        $param = Param::create([
            'param' => $request->job_level_name,
            'category' => 'job_level',
        ]);

        return ResponseFormatter::success(
            new ParamResource($param),
            'success create job level'
        );
    }

    public function update(Request $request, Param $param)
    {
        $this->validate($request, [
            'job_level_name' => ['required', 'string']
        ]);

        $param_cek = Param::where([['param', $request->job_level_name], ['category', 'job_level']])->where('id', '!=', $param->id)->count();
        if($param_cek > 0) {
            return ResponseFormatter::error([
                'message' => 'job level name already in input',
            ], 'error create job level', 422);
        }

        $input['param'] = $request->job_level_name;
        $param->update($input);

        return ResponseFormatter::success(
            new ParamResource($param),
            'success update job level name'
        );
    }

    public function delete(Param $param)
    {
        $cek_param = $param->job_level_employee()->count();
        if($cek_param > 0) {
            return ResponseFormatter::error([
                'message' => 'The job level already used by employee'
            ], 'delete job level data failed', 422);
        }

        $result = $param->delete();
        return ResponseFormatter::success(
            $result,
            'success delete oraganization data'
        );
    }
}
