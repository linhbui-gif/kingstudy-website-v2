<?php

namespace Modules\Front\Traits;

trait ApiResponseTrait
{
    public function successResponseJson($data = [], $message = 'success', $code = 200)
    {
        return response()->json(
            [
                'data' => $data,
                'message' => $message,
                'code' => $code
            ],
            $code
        );
    }

    public function errorResponseJson($message = 'error', $code = 400, $exception = null, $data = [])
    {
        return response()->json(
            [
                'data' => $data,
                'message' => $message,
                'code' => $code,
                'exception' => $exception,
                'trace' => null
            ],
            $code
        );
    }
}
