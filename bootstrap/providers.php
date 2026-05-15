<?php

use App\Providers\AppServiceProvider;
use \Modules\User\App\Providers\UsersServiceProvider;
use \App\Providers\UtilsServiceProvider;

return [
    AppServiceProvider::class,
    UsersServiceProvider::class,
    UtilsServiceProvider::class,
];
