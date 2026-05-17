<?php

namespace Modules\Ticket\App\Filters\Tickets;

use App\Filters\BaseFilters;

class TicketFilters extends BaseFilters implements TicketFiltersInterface
{

    protected array $filters = [
        'status'
    ];

    public function status(string $status): void
    {
        $this->query->where('status', $status);
    }

}