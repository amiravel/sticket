<?php

namespace Modules\Ticket\App\Providers;

use Illuminate\Support\Facades\Route;
use Modules\Ticket\App\Http\Middleware\IsAdmin;
use \Modules\User\App\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{


    public function boot()
    {
        $this->routes(function () {

            Route::prefix('ticket/api')
                ->middleware('auth:sanctum')
                ->group(base_path('modules/Ticket/routes/api.php'));

            Route::prefix('ticket/api/admin')
                ->middleware(['auth:sanctum', IsAdmin::class])
                ->group(base_path('modules/Ticket/routes/admin.php'));

        });
    }

}