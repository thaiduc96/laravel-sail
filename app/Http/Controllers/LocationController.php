<?php

namespace App\Http\Controllers;

use App\Facades\DistrictFacade;
use App\Facades\ProvinceFacade;
use App\Facades\WardFacade;
use App\Models\Province;
use App\Repositories\Facades\DistrictRepository;
use App\Repositories\Facades\ProvinceRepository;
use App\Repositories\Facades\WardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function province(Request $request)
    {
        $res = ProvinceFacade::filter($request->all());
        return $this->responseSuccessList($res, 'Province');
    }

    public function provinceOptions(Request $request)
    {
        try {
            $data = ProvinceRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function districtOptions(Request $request)
    {
        try {
            $data = DistrictRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function district(Request $request)
    {
        $res = DistrictFacade::filter($request->all());
        return $this->responseSuccessList($res, 'District');
    }

    public function ward(Request $request)
    {
        $res = WardFacade::filter($request->all());
        return $this->responseSuccessList($res, 'Ward');
    }
    public function wardOptions(Request $request)
    {
        try {
            $data = WardRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function region(Request $request)
    {
        $res =[
            ALL => trans('validation.custom.all'),
            NORTH => trans('validation.custom.north'),
            SOUTH => trans('validation.custom.south'),
        ];
        return $this->successResponse($res);
    }
}
