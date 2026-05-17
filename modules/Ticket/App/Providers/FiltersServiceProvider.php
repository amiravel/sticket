<?php

namespace Modules\Ticket\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Ticket\App\Filters\Tickets\TicketFilters;
use Modules\Ticket\App\Filters\Tickets\TicketFiltersInterface;

class FiltersServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(TicketFiltersInterface::class, TicketFilters::class);
    }

}