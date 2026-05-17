<?php

namespace Modules\Ticket\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Ticket\App\Services\Ticket\TicketService;
use Modules\Ticket\App\Services\Ticket\TicketServiceInterface;

class ServicesServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(TicketServiceInterface::class, TicketService::class);
    }

}