<?php

namespace App\Http\Controllers;

use App\Repositories\Facades\WarehouseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\WarehouseFacade;
use App\Http\Controllers\Controller;
use App\Http\Resources\Warehouse\WarehouseResource;
use App\Http\Resources\Warehouse\WarehouseCollection;
use App\Http\Requests\Warehouse\CreateWarehouseRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseRequest;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $res = WarehouseFacade::filter($request->all());
        return $this->responseSuccessList($res, "Warehouse");
    }

    public function options(Request $request)
    {
        try {
            $data = WarehouseRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateWarehouseRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = WarehouseFacade::create($request->all());
            $data = WarehouseFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new WarehouseResource($data));
    }

    public function update(UpdateWarehouseRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = WarehouseFacade::update($id, $request->all());
            $data = WarehouseFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new WarehouseResource($data));
    }

    public function show($id)
    {
        $model = WarehouseFacade::find($id);
        return $this->successResponse(new WarehouseResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            WarehouseFacade::delete($id);
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
            WarehouseFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }
}
