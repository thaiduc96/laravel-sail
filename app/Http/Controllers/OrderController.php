<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\OrderFacade;
use App\Repositories\Facades\OrderRepository;
use App\Http\Resources\Order\OrderResource;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $res = OrderFacade::filter($request->all());
        return $this->responseSuccessList($res, "Order");
    }

    public function options(Request $request)
    {
        try {
            $data = OrderRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateOrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = OrderFacade::create($request->only('provider_id','customer_id','warehouse_id','items'));
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = OrderFacade::find($data->id);
        return $this->successResponse(new OrderResource($data));
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = OrderFacade::update($id, $request->only('provider_id','customer_id','warehouse_id','items'));
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = OrderFacade::find($data->id);
        return $this->successResponse(new OrderResource($data));
    }

    public function show($id)
    {
        $model = OrderFacade::find($id);
        return $this->successResponse(new OrderResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            OrderFacade::delete($id);
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
            OrderFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }
}
