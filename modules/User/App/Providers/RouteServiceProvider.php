<?php

namespace Modules\User\App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->routes(function () {

            Route::prefix('user/api')
                ->group(base_path('modules/User/routes/api.php'));

        });
    }

}