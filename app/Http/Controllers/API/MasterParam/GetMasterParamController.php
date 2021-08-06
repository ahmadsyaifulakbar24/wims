<?php

namespace App\Http\Controllers\API\MasterParam;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\MasterParam\MasterParamResource;
use App\Models\Bank;
use App\Models\City;
use App\Models\MasterParam;
use App\Models\Province;
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

    public function bank()
    {
        $data = Bank::orderBy('id', 'ASC')->get();
        return ResponseFormatter::success(
            $data,
            'success get bank data'
        );
    }

    public function province()
    {
        $province = Province::all();
        return ResponseFormatter::success(
            $province,
            'success get province data'
        );
    }

    public function city(Province $province)
    {
        $city = City::where('province_id', $province->id)->get();
        return ResponseFormatter::success(
            $city,
            'success get city data'
        );
    }

    public function jkk()
    {
        return $this->MasterQuery('jkk', 'success get jkk data');
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
