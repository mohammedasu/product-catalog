<?php
namespace App\Exceptions;

use App\Classes\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception): JsonResponse
    {
        if ($exception instanceof ModelNotFoundException) {
            return ApiResponse::fail([], 'Resource not found', 404);
        }

        return ApiResponse::fail($exception->getMessage(), 'Internal Server Error', $exception->getCode());
    }
}
