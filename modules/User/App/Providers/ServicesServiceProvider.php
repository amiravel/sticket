<?php

namespace Modules\User\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\User\App\Services\User\UserService;
use Modules\User\App\Services\User\UserServiceInterface;

class ServicesServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }
}