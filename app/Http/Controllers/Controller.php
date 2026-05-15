<?php

namespace App\Http\Controllers;

use App\Utils\Response\ResponseInterface;

abstract class Controller
{
    public function __construct(
        protected $service,
        protected ResponseInterface $response,
    )
    {

    }
}
