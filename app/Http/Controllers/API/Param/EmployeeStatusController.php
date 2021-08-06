<?php

namespace App\Http\Controllers\API\Param;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Param\ParamResource;
use App\Models\Param;
use Illuminate\Http\Request;

class EmployeeStatusController extends Controller
{
    public function fetch()
    {
        $employee_status = Param::where('category', 'employee_status')->orderBy('param', 'ASC')->get();
        return ResponseFormatter::success(
            ParamResource::collection($employee_status),
            'success get employee status data'
        );
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'employee_status_name' => ['required', 'string'],
            'end_date' => ['required', 'boolean']
        ]);

        $param_cek = Param::where([['param', $request->employee_status_name], ['category', 'employee_status']])->count();
        if($param_cek > 0) {
            return ResponseFormatter::error([
                'message' => 'duplicate custom employee status name',
            ], 'error create employee status', 422);
        }

        $param = Param::create([
            'param' => $request->employee_status_name,
            'category' => 'employee_status',
            'option' => $request->end_date
        ]);

        return ResponseFormatter::success(
            new ParamResource($param),
            'success create employee status'
        );
    }

    public function update(Request $request, Param $param)
    {
        $this->validate($request, [
            'employee_status_name' => ['required', 'string']
        ]);

        $param_cek = Param::where([['param', $request->employee_status_name], ['category', 'employee_status']])->where('id', '!=', $param->id)->count();
        if($param_cek > 0) {
            return ResponseFormatter::error([
                'message' => 'duplicate custom employee status name',
            ], 'error employee status level', 422);
        }

        $input['param'] = $request->employee_status_name;
        $param->update($input);

        return ResponseFormatter::success(
            new ParamResource($param),
            'success update employee status name'
        );
    }

    public function delete(Param $param)
    {
        $cek_param = $param->employee_status()->count();
        if($cek_param > 0) {
            return ResponseFormatter::error([
                'message' => 'The employee status already used by employee'
            ], 'delete employee status data failed', 422);
        }

        $result = $param->delete();
        return ResponseFormatter::success(
            $result,
            'success delete employee status data'
        );
    }
}
