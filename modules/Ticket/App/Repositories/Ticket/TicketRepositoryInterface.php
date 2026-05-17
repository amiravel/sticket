<?php

namespace Modules\Ticket\App\Repositories\Ticket;

use App\Repositories\BaseRepositoryInterface;

interface TicketRepositoryInterface extends BaseRepositoryInterface
{

    public function bulkUpdate(array $ids, array $data);

}