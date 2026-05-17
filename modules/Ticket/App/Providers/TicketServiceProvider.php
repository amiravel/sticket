<?php

namespace Modules\Ticket\App\Providers;

use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../Database/Migrations');

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ServicesServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(FiltersServiceProvider::class);
    }

}