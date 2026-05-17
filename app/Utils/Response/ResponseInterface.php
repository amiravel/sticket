<?php

namespace App\Utils\Response;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as Json;

interface ResponseInterface
{

    public function ok(): \Illuminate\Http\JsonResponse;

    public function item($data): \Illuminate\Http\JsonResponse;

    public function paginate(ResourceCollection $data): \Illuminate\Http\JsonResponse;

    public function error(string $message, $code = Json::HTTP_BAD_REQUEST): \Illuminate\Http\JsonResponse;


}