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

    public function education()
    {
        return $this->MasterQuery('education', 'success get education data');
    }

    public function religion()
    {
        return $this->MasterQuery('religion', 'success get religion data');
    }

    public function marital_status()
    {
        return $this->MasterQuery('marital_status', 'success get marital status data');
    }

    public function blood_type()
    {
        return $this->MasterQuery('blood_type', 'success get blood type data');
    }

    public function MasterQuery($category, $message)
    {
        $data = MasterParam::where('category', $category)->orderBy('order', 'DESC')->get();
        return ResponseFormatter::success(
            MasterParamResource::collection($data),
            $message
        );
    }
}
