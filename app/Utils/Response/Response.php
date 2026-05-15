<?php

namespace App\Utils\Response;

use Symfony\Component\HttpFoundation\Response as Json;

class Response implements ResponseInterface
{

    public function ok(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'ok',
            'code' => Json::HTTP_OK
        ]);
    }
}