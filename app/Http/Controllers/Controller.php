<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorCode;
use App\Exceptions\InvalidException;
use App\Exceptions\ThirdPartyException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseSuccessList($list, $model)
    {
        if (!empty(request()->page) or !empty(request()->limit)) {
            $collectionName = "\App\Modules\AdminApi\Http\Resources\\$model\\" .$model . "Collection";
            $data = new $collectionName($list);
        } else {
            $resourceName =  "\App\Modules\AdminApi\Http\Resources\\$model\\" .$model . "Resource";
            $data = [
                'data' => $resourceName::collection($list)
            ];
        }
        return $this->successResponse($data);
    }

    protected function response($data, $success = true, $status = 200)
    {
        return response()->json([
            'success' => $success,
            'data'    => $data,
        ], $status);
    }

    protected function successResponse($data)
    {
        return $this->response($data);
    }

    protected function failedResponse($message = 'Invalid input data.', $extraData = [])
    {
        throw new InvalidException(
            $message,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            null,
            ErrorCode::VALIDATION_ERROR,
            $extraData
        );
    }

    protected function errorResponse($message = 'Server Error. Please contact technical for supporting.', $extraData = [])
    {
        throw new ThirdPartyException(
            $message,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            null,
            ErrorCode::VALIDATION_ERROR,
            $extraData
        );
    }

}
