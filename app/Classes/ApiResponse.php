<?php

namespace App\Classes;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiResponse
{
    public static function throw(mixed $e, string $message ="Something went wrong! Process not completed", int $code = 500)
    {
        Log::info($e);
        throw new HttpResponseException(response()->json(["message"=> $message, 'errors' => $e], $code));
    }

    public static function send(mixed $result , string $message , int $code=200): JsonResponse
    {
        $response=[
            'message' => $message,
            'data'    => $result
        ];

        if (empty($message)) {
            unset($response['message']); 
        }

        if(empty($result)) {
            unset($response['data']);
        }
        return response()->json($response, $code);
    }

    public static function fail(mixed $errors, string $message = 'fail validation', int $code = 500): JsonResponse
    {
        return self::throw($errors, $message, $code);
    }
}
