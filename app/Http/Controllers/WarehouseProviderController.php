<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\WarehouseProviderFacade;
use App\Repositories\Facades\WarehouseProviderRepository;
use App\Http\Controllers\Controller;
use App\Http\Resources\WarehouseProvider\WarehouseProviderResource;
use App\Http\Resources\WarehouseProvider\WarehouseProviderCollection;
use App\Http\Requests\WarehouseProvider\CreateWarehouseProviderRequest;
use App\Http\Requests\WarehouseProvider\UpdateWarehouseProviderRequest;

class WarehouseProviderController extends Controller
{
    public function index(Request $request)
    {
        $res = WarehouseProviderFacade::filter($request->all());
        return $this->responseSuccessList($res, "WarehouseProvider");
    }

    public function options(Request $request)
    {
        try {
            $data = WarehouseProviderRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateWarehouseProviderRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = WarehouseProviderFacade::create($request->only('name','description','provider_id','warehouse_ids'));
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = WarehouseProviderFacade::find($data->id);
        return $this->successResponse(new WarehouseProviderResource($data));
    }

    public function update(UpdateWarehouseProviderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = WarehouseProviderFacade::update($id, $request->only('name','description','provider_id','warehouse_ids'));
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = WarehouseProviderFacade::find($data->id);
        return $this->successResponse(new WarehouseProviderResource($data));
    }

    public function show($id)
    {
        $model = WarehouseProviderFacade::find($id);
        return $this->successResponse(new WarehouseProviderResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            WarehouseProviderFacade::delete($id);
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
            WarehouseProviderFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }
}
