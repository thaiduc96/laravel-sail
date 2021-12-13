<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\CustomerFacade;
use App\Repositories\Facades\CustomerRepository;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $res = CustomerFacade::filter($request->all());
        return $this->responseSuccessList($res, "Customer");
    }

    public function options(Request $request)
    {
        try {
            $filter = $request->all();
            $columns = $filter['columns'] ?? [];
            if (empty($columns)) {
                $columns = [
                    'id',
                    'sap_id',
                    'name',
                    'other_name',
                    'phones'
                ];
            }
            if (!in_array('sap_id', $columns)) {
                $columns [] = 'sap_id';
            }

            $filter['columns'] = $columns;
            $data = CustomerRepository::options($filter);
            foreach ($data as &$item) {
                if (!empty($item['sap_id'])) {
                    $item['name'] = $item['sap_id'] . '-' . $item['name'];
                } else {
                    $item['name'] = $item['name'] . '-' . implode(',', $item['phones']);
                }
                if (!empty($item['other_name'])) {
                    $item['name'] = $item['name'] . '-' . $item['other_name'];
                }
            }
        } catch (\Exception $e) {
            $data = [];
        }
        return $this->successResponse($data);
    }

    public function store(CreateCustomerRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = CustomerFacade::create($request->only('other_name', 'name', 'email', 'phones'));
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = CustomerFacade::find($data->id);
        return $this->successResponse(new CustomerResource($data));
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = CustomerFacade::update($id, $request->only('other_name', 'name', 'email', 'phones'));
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        $data = CustomerFacade::find($data->id);
        return $this->successResponse(new CustomerResource($data));
    }

    public function show($id)
    {
        $model = CustomerFacade::find($id);
        return $this->successResponse(new CustomerResource($model));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            CustomerFacade::delete($id);
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
            CustomerFacade::recovery($id);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $this->successResponse(true);
    }
}
