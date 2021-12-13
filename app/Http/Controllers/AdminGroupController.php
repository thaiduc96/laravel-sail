<?php

namespace App\Http\Controllers;

use App\Facades\AdminPermissionFacade;
use App\Repositories\Facades\AdminGroupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\AdminGroupFacade;
use App\Http\Resources\AdminGroup\AdminGroupResource;
use App\Http\Requests\AdminGroup\CreateAdminGroupRequest;
use App\Http\Requests\AdminGroup\UpdateAdminGroupRequest;

class AdminGroupController extends Controller
{
    public function permission($groupId,Request $request)
    {
        if($request->isMethod('GET')){
            $res = AdminPermissionFacade::filter($groupId,$request->all());
            return $this->successResponse($res);
        }else{
            try {
                AdminPermissionFacade::update($groupId,$request->permission_ids);
            } catch (\Exception $e) {
                throw $e;
            }
            return $this->successResponse(true);
        }
    }

    public function index(Request $request)
    {
        $res = AdminGroupFacade::filter($request->all());
        return $this->responseSuccessList($res, "AdminGroup");
    }

    public function options(Request $request)
    {
        try {
            $data = AdminGroupRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateAdminGroupRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = AdminGroupFacade::create($request->only('name','description','status'));
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = AdminGroupFacade::find($data->id);
        return $this->successResponse(new AdminGroupResource($data));
    }

    public function update(UpdateAdminGroupRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = AdminGroupFacade::update($id, $request->only('name','description','status'));
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = AdminGroupFacade::find($data->id);
        return $this->successResponse(new AdminGroupResource($data));
    }

    public function show($id)
    {
        $model = AdminGroupFacade::find($id);
        return $this->successResponse(new AdminGroupResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            AdminGroupFacade::delete($id);
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
            AdminGroupFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }
}
