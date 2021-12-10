<?php

namespace App\Http\Controllers;

use App\Repositories\Facades\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\ProductFacade;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $res = ProductFacade::filter($request->all());
        return $this->responseSuccessList($res, "Product");
    }

    public function options(Request $request)
    {
        try {
            $data = ProductRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = ProductFacade::create($request->all());
            $data = ProductFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new ProductResource($data));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = ProductFacade::update($id, $request->all());
            $data = ProductFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new ProductResource($data));
    }

    public function show($id)
    {
        $model = ProductFacade::find($id);
        return $this->successResponse(new ProductResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            ProductFacade::delete($id);
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
            ProductFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }
}
