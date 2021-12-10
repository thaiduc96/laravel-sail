<?php

namespace App\Http\Controllers;

use App\Repositories\Facades\DistrictRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\DistrictFacade;
use App\Http\Controllers\Controller;
use App\Http\Resources\District\DistrictResource;
use App\Http\Resources\District\DistrictCollection;
use App\Http\Requests\District\CreateDistrictRequest;
use App\Http\Requests\District\UpdateDistrictRequest;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        $res = DistrictFacade::filter($request->all());
        return $this->responseSuccessList($res, "District");
    }

    public function options(Request $request)
    {
        try {
            $data = DistrictRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateDistrictRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = DistrictFacade::create($request->all());
            $data = DistrictFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new DistrictResource($data));
    }

    public function update(UpdateDistrictRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = DistrictFacade::update($id, $request->all());
            $data = DistrictFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new DistrictResource($data));
    }

    public function show($id)
    {
        $model = DistrictFacade::find($id);
        return $this->successResponse(new DistrictResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            DistrictFacade::delete($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }

    public function recovery($id)
    {
        DB::beginTransaction();
        try {
            DistrictFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }
}
