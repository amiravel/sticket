<?php

namespace Modules\Ticket\App\Repositories\Ticket;

use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Modules\Ticket\App\Filters\Tickets\TicketFiltersInterface;
use Modules\Ticket\App\Models\Ticket;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{

    public function __construct(Ticket $model)
    {
        parent::__construct($model);
        $this->filter = App::make(TicketFiltersInterface::class);
    }

    public function bulkUpdate(array $ids, array $data)
    {
        $this->query->whereIn('id', $ids)
            ->update($data);
    }
}