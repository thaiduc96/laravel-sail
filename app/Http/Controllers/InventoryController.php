<?php

namespace App\Http\Controllers;

use App\Facades\ImportMeterFacades;
use App\Http\Requests\Import\ImportInventoryRequest;
use App\Http\Requests\ImportMeter\CreateImportMeterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\InventoryFacade;
use App\Repositories\Facades\InventoryRepository;
use App\Http\Controllers\Controller;
use App\Http\Resources\Inventory\InventoryResource;
use App\Http\Resources\Inventory\InventoryCollection;
use App\Http\Requests\Inventory\CreateInventoryRequest;
use App\Http\Requests\Inventory\UpdateInventoryRequest;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $res = InventoryFacade::filter($request->all());
        return $this->responseSuccessList($res, "Inventory");
    }

    public function options(Request $request)
    {
        try {
            $data = InventoryRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateInventoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = InventoryFacade::create($request->all());
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = InventoryFacade::find($data->id);
        return $this->successResponse(new InventoryResource($data));
    }

    public function update(UpdateInventoryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = InventoryFacade::update($id, $request->all());
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = InventoryFacade::find($data->id);
        return $this->successResponse(new InventoryResource($data));
    }

    public function show($id)
    {
        $model = InventoryFacade::find($id);
        return $this->successResponse(new InventoryResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            InventoryFacade::delete($id);
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
            InventoryFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }

    public function create(ImportInventoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = InventoryFacade::create($request->all());
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse($data);
    }

    public function import(ImportInventoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = InventoryFacade::create($request->all());
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse($data);
    }
}
