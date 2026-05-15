<?php

namespace Modules\User\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\User\App\Adapters\UserTokenAdapter;
use Modules\User\App\Adapters\UserTokenAdapterInterface;

class AdaptersServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(UserTokenAdapterInterface::class, UserTokenAdapter::class);
    }

}