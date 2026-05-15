<?php

namespace App\Utils\Response;

use Illuminate\Http\Response;

interface ResponseInterface
{

    public function ok(): \Illuminate\Http\JsonResponse;

//    public function item();



}