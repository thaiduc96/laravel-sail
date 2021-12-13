<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\ProviderFacade;
use App\Repositories\Facades\ProviderRepository;
use App\Http\Resources\Provider\ProviderResource;
use App\Http\Requests\Provider\UpdateProviderRequest;

class ProviderController extends Controller
{
    public function index(Request $request)
    {
        $res = ProviderFacade::filter($request->all());
        return $this->responseSuccessList($res, "Provider");
    }

    public function options(Request $request)
    {
        try {
            $data = ProviderRepository::options($request->all());
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function show($id)
    {
        $model = ProviderFacade::find($id);
        return $this->successResponse(new ProviderResource($model));
    }

    public function update(UpdateProviderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = ProviderFacade::update($id, $request->only('phones'));
            $data = ProviderFacade::find($data->id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(new ProviderResource($data));
    }

}
