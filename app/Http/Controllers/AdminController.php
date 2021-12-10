<?php

namespace App\Http\Controllers;

use App\Repositories\Facades\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\AdminFacade;
use App\Http\Resources\Admin\AdminResource;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $res = AdminFacade::filter($request->all());
        return $this->responseSuccessList($res, "Admin");
    }

    public function options(Request $request)
    {
        try {
            $data = AdminRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateAdminRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = AdminFacade::create($request->all());
            $data = AdminFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new AdminResource($data));
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = AdminFacade::update($id, $request->all());
            $data = AdminFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new AdminResource($data));
    }

    public function show($id)
    {
        $model = AdminFacade::find($id);
        return $this->successResponse(new AdminResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            AdminFacade::delete($id);
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
            AdminFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }
}
