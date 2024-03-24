<?php

namespace App\Http\Controllers\api;

trait ApiResponseTrait
{
    public function apiResponse($data = [], $status = 200, $message = null) {
        $array = [
            'data' => $data,
            'status' => $status,
            'message' => $message
        ];
        return response($array);
    }
}
