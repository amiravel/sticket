<?php

namespace App\Utils\Response;

use Symfony\Component\HttpFoundation\Response as Json;

class Response implements ResponseInterface
{

    public function ok(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => Json::HTTP_OK,
            'message' => 'ok',
        ]);
    }

    public function item($data): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => Json::HTTP_OK,
            'message' => 'ok',
            'data' => $data,
        ]);
    }
}