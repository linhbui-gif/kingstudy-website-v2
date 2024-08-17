<?php
namespace Modules\Front\Http\Controllers\Api;
use App\Http\Controllers\Controller;

class BaseController extends Controller {
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function successResponseJson($data = [], $message = 'success', $code = 200)
    {
        return response()->json(
            [
                'data' => $data,
                'message' => $message,
                'status' => $code
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
                'status' => $code,
                'exception' => $exception,
                'trace' => $exception ? $exception->getTrace() : ''
            ],
            $code
        );
    }
}
