<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiResponseController extends Controller
{
    public function successResponse(mixed $data, string $status, string $message, int $statusCode = 200)
    {
        $result = [];
        $result['data'] = $data;
        $result['status'] = $status;
        $result['message'] = $message;
        return response()->json($result, $statusCode);
    }

    public function errorResponse(string $status = 'error', string $message, int $statusCode)
    {
        $result = [];
        $result['status'] = $status;
        $result['message'] = $message;
        return response()->json($result, $statusCode);
    }
}
