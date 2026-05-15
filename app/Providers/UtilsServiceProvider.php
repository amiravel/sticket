<?php

namespace App\Providers;

use App\Utils\Response\Response;
use App\Utils\Response\ResponseInterface;
use Illuminate\Support\ServiceProvider;

class UtilsServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(ResponseInterface::class, Response::class);
    }

}