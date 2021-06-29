<?php

namespace App\Http\Controllers\API\MasterParam;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\MasterParam\MasterParamResource;
use App\Models\MasterParam;
use Illuminate\Http\Request;

class GetMasterParamController extends Controller
{
    public function employee_reach()
    {
        return $this->MasterQuery('employee_reach', 'success get employee reach data');
    }

    public function MasterQuery($category, $message)
    {
        $data = MasterParam::where('category', $category)->orderBy('order', 'DESC')->get();
        return ResponseFormatter::success(
            $message,
            MasterParamResource::collection($data)
        );
    }
}
