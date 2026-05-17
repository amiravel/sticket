<?php

namespace App\Utils\Response;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response as Json;

class Response implements ResponseInterface
{

    public function ok(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => Json::HTTP_OK,
            'message' => 'ok',
            'error' => false,
        ]);
    }

    public function item($data): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => Json::HTTP_OK,
            'message' => 'ok',
            'error' => false,
            'data' => $data,
        ]);
    }

    public function paginate(ResourceCollection $data): \Illuminate\Http\JsonResponse
    {
        $data = $data->resource ?? $data;
        return response()->json([
            'code' => Json::HTTP_OK,
            'message' => 'ok',
            'error' => false,
            'data' => method_exists($data, 'items') ? $data->items() : $data,
            'meta' => [
                'current_page' => method_exists($data, 'currentPage') ? $data->currentPage() : null,
                'next_page' => method_exists($data, 'nextPageUrl') ? $data->nextPageUrl() : null,
                'last_page' => method_exists($data, 'lastPage') ? $data->lastPage() : null,
                'path' => method_exists($data, 'path') ? $data->path() : null,
                'total' => method_exists($data, 'total') ? $data->total() : null,
                'per_page' => method_exists($data, 'perPage') ? $data->perPage() : null,
            ],
        ]);
    }

    public function error(string $message, $code = Json::HTTP_BAD_REQUEST): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'error' => true,
        ]);
    }
}