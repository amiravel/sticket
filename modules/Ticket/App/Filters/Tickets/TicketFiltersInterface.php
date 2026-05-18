<?php

namespace Modules\Ticket\App\Filters\Tickets;

use App\Filters\BaseFiltersInterface;

interface TicketFiltersInterface extends BaseFiltersInterface
{

    public function status(string $status): void;

    public function ids_in(array $ids): void;

}