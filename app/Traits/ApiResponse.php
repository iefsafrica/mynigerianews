<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

Trait ApiResponse
{
    protected function successResponse($data, $message = '', $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success'  => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }
    protected function errorResponse($message = '', $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success'  => false,
            'message' => $message
        ], $code);
    }


}
