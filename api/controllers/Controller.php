<?php

namespace GromIT\Instagram\Api\Controllers;

use Exception;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use October\Rain\Exception\ValidationException;

abstract class Controller extends \Illuminate\Routing\Controller
{

    use ValidatesRequests;

    protected function jsonResponse($data, int $statusCode = 200): JsonResponse
    {
        return response()->json($data, $statusCode, [], JSON_UNESCAPED_UNICODE);
    }

    protected function errorResponse($errorMessage, int $statusCode, $extraData = null): JsonResponse
    {
        $data = [
            'error' => $errorMessage
        ];

        if ($extraData !== null) {
            $data['data'] = $extraData;
        }

        return response()->json($data, $statusCode);
    }

    /**
     * @param \Exception $exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function exceptionResponse(Exception $exception): JsonResponse
    {
        if ($exception instanceof ValidationException) {
            return $this->errorResponse($exception->getMessage(), 406, $exception->getErrors());
        }

        if ($exception instanceof LaravelValidationException) {
            return $this->errorResponse($exception->getMessage(), 406, $exception->errors());
        }

        return $this->errorResponse($exception->getMessage(), 500);
    }
}
