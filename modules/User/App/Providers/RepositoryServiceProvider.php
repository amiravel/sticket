<?php

namespace Modules\User\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\User\App\Repositories\User\UserRepository;
use Modules\User\App\Repositories\User\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

}