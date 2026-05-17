<?php

use App\Providers\AppServiceProvider;
use Modules\Ticket\App\Providers\TicketServiceProvider;
use \Modules\User\App\Providers\UsersServiceProvider;
use \App\Providers\UtilsServiceProvider;

return [
    AppServiceProvider::class,
    UtilsServiceProvider::class,
    UsersServiceProvider::class,
    TicketServiceProvider::class,
];
