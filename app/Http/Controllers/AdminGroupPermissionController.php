<?php

namespace App\Http\Controllers;

use App\Repositories\Facades\AdminGroupPermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\AdminGroupPermissionFacade;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminGroupPermission\AdminGroupPermissionResource;
use App\Http\Resources\AdminGroupPermission\AdminGroupPermissionCollection;
use App\Http\Requests\AdminGroupPermission\CreateAdminGroupPermissionRequest;
use App\Http\Requests\AdminGroupPermission\UpdateAdminGroupPermissionRequest;

class AdminGroupPermissionController extends Controller
{
    public function index(Request $request)
    {
        $res = AdminGroupPermissionFacade::filter($request->all());
        return $this->responseSuccessList($res, "AdminGroupPermission");
    }

    public function options(Request $request)
    {
        try {
            $data = AdminGroupPermissionRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateAdminGroupPermissionRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = AdminGroupPermissionFacade::create($request->all());
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = AdminGroupPermissionFacade::find($data->id);
        return $this->successResponse(new AdminGroupPermissionResource($data));
    }

    public function update(UpdateAdminGroupPermissionRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = AdminGroupPermissionFacade::update($id, $request->all());
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = AdminGroupPermissionFacade::find($data->id);
        return $this->successResponse(new AdminGroupPermissionResource($data));
    }

    public function show($id)
    {
        $model = AdminGroupPermissionFacade::find($id);
        return $this->successResponse(new AdminGroupPermissionResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            AdminGroupPermissionFacade::delete($id);
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
            AdminGroupPermissionFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }
}
