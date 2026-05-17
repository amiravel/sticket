<?php

namespace Modules\Ticket\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Ticket\App\Repositories\Log\LogRepository;
use Modules\Ticket\App\Repositories\Log\LogRepositoryInterface;
use Modules\Ticket\App\Repositories\Reply\ReplyRepository;
use Modules\Ticket\App\Repositories\Reply\ReplyRepositoryInterface;
use Modules\Ticket\App\Repositories\Ticket\TicketRepository;
use Modules\Ticket\App\Repositories\Ticket\TicketRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(ReplyRepositoryInterface::class, ReplyRepository::class);
        $this->app->bind(LogRepositoryInterface::class, LogRepository::class);
    }

}