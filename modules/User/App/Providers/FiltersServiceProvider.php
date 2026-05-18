<?php

namespace Modules\User\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\User\App\Filters\Users\UsersFilter;
use Modules\User\App\Filters\Users\UsersFilterInterface;

class FiltersServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UsersFilterInterface::class, UsersFilter::class);
    }

    public function boot(): void
    {
    }
}
