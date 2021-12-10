<?php

namespace App\Http\Controllers;

use App\Repositories\Facades\MenuRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\MenuFacade;
use App\Http\Controllers\Controller;
use App\Http\Resources\Menu\MenuResource;
use App\Http\Resources\Menu\MenuCollection;
use App\Http\Requests\Menu\CreateMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $res = MenuFacade::filter($request->all());
        return $this->responseSuccessList($res, "Menu");
    }

    public function options(Request $request)
    {
        try {
            $data = MenuRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateMenuRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = MenuFacade::create($request->all());
            $data = MenuFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new MenuResource($data));
    }

    public function update(UpdateMenuRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = MenuFacade::update($id, $request->all());
            $data = MenuFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new MenuResource($data));
    }

    public function show($id)
    {
        $model = MenuFacade::find($id);
        return $this->successResponse(new MenuResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            MenuFacade::delete($id);
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
            MenuFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }
}
