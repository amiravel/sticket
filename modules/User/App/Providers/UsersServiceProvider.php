<?php

namespace Modules\User\App\Providers;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../Database/Migrations');
        $this->app->register(\Modules\User\App\Providers\RouteServiceProvider::class);
        $this->app->register(\Modules\User\App\Providers\ServicesServiceProvider::class);
        $this->app->register(\Modules\User\App\Providers\RepositoryServiceProvider::class);
    }


    public function boot()
    {

    }

}