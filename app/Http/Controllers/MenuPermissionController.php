<?php

namespace App\Http\Controllers;

use App\Repositories\Facades\MenuPermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\MenuPermissionFacade;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuPermission\MenuPermissionResource;
use App\Http\Resources\MenuPermission\MenuPermissionCollection;
use App\Http\Requests\MenuPermission\CreateMenuPermissionRequest;
use App\Http\Requests\MenuPermission\UpdateMenuPermissionRequest;

class MenuPermissionController extends Controller
{
    public function index(Request $request)
    {
        $res = MenuPermissionFacade::filter($request->all());
        return $this->responseSuccessList($res, "MenuPermission");
    }

    public function options(Request $request)
    {
        try {
            $data = MenuPermissionRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateMenuPermissionRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = MenuPermissionFacade::create($request->all());
            $data = MenuPermissionFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new MenuPermissionResource($data));
    }

    public function update(UpdateMenuPermissionRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = MenuPermissionFacade::update($id, $request->all());
            $data = MenuPermissionFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new MenuPermissionResource($data));
    }

    public function show($id)
    {
        $model = MenuPermissionFacade::find($id);
        return $this->successResponse(new MenuPermissionResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            MenuPermissionFacade::delete($id);
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
            MenuPermissionFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }
}
