<?php

namespace Modules\Ticket\App\Filters\Tickets;

use App\Filters\BaseFilters;

class TicketFilters extends BaseFilters implements TicketFiltersInterface
{

    protected array $filters = [
        'status',
        'ids_in'
    ];

    public function status(string $status): void
    {
        $this->query->where('status', $status);
    }

    public function ids_in(array $ids): void
    {
        $this->query->whereIn('id', $ids);
    }

}