<?php

namespace App\Exceptions;

use App\Helpers\LogHelper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            if ($exception instanceof ValidationException) {
                $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                $errors = $exception->errors();
                $errorCode = ErrorCode::VALIDATION_ERROR;
                $errorMessage = $exception->getMessage();

                if (isset($exception->validator)) {
                    $failedRules = $exception->validator->failed();
                    $errorCode = $errorMessage = [];

                    foreach ($failedRules as $name => $types) {

                        foreach ($types as $type => $values) {

                            $errorCode[] = ErrorCode::VALIDATION_ERROR . '_' . $name . '_' . strtolower($type);
                        }
                    }
                    $errorCode = implode("\r\n", $errorCode);
                    foreach ($errors as $name => $messages) {
                        foreach ($messages as $message) {
                            $errorMessage[] = $message;
                        }
                    }
                    $errorMessage = implode("\r\n", $errorMessage);

                    $errorMessageArray = $errors;
                }

            } else if ($exception instanceof InvalidException) {
                $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                $errorCode = $exception->getErrorCode();
                $errorCode = $errorCode ?: ErrorCode::VALIDATION_ERROR;
                $errorMessage = $exception->getMessage();

            } else if ($exception instanceof NotAllowException) {
                $statusCode = Response::HTTP_FORBIDDEN;
                $errorCode = $exception->getErrorCode();
                $errorCode = $errorCode ?: ErrorCode::FORBIDDEN;
                $errorMessage = $exception->getMessage();

            } else if ($exception instanceof ModelNotFoundException) {
                $statusCode = Response::HTTP_NOT_FOUND;
                $errorCode = ErrorCode::NOT_FOUND;
                $errorMessage = trans('message.model_not_found');
            } else if ($exception instanceof NotFoundException) {
                $statusCode = Response::HTTP_NOT_FOUND;
                $errorCode = $exception->getErrorCode();
                $errorCode = $errorCode ?: ErrorCode::NOT_FOUND;
                $errorMessage = $exception->getMessage();

            } else if ($exception instanceof AuthenticationException) {
                $statusCode = Response::HTTP_UNAUTHORIZED;
                $errorCode = $exception->getCode();
                $errorCode = $errorCode ?: ErrorCode::USER_UNAUTHORIZED;
                $errorMessage = trans('message.unauthenticated');
            } else if ($exception instanceof UnauthorizedException) {
                $statusCode = Response::HTTP_UNAUTHORIZED;
                $errorCode = $exception->getErrorCode();
                $errorCode = $errorCode ?: ErrorCode::ACTION_UNAUTHORIZED;
                $errorMessage = $exception->getMessage();

            } else if ($exception instanceof ThirdPartyException) {
                $statusCode = $exception->getCode();
                $errorCode = $exception->getErrorCode();
                $errorMessage = $exception->getMessage();
            } else if ($exception instanceof AwsException) {
                $statusCode = $exception->getStatusCode();
                $errorCode = $exception->getAwsErrorCode();
                $errorMessage = $exception->getMessage();
                LogHelper::loggingAwsError($errorMessage);
            } else {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                $errorCode = ErrorCode::SERVER_ERROR;
                $errorMessage = $exception->getMessage();
            }

            $res = [
                'success' => false,
                'errorCode' => $errorCode,
                'errorMessage' => $errorMessage
            ];
            if (!empty($errorMessageArray)) {
                $res['errorMessageArray'] = $errorMessageArray;
            }
            return response()->json($res, $statusCode);
        } else {
            return parent::render($request, $exception);
        }
    }
}
