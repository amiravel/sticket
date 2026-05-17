<?php

namespace Modules\Ticket\App\Services\Ticket;

use App\Services\BaseCrudServiceInterface;

interface TicketServiceInterface extends BaseCrudServiceInterface
{

    public function bulkApprove(array $data);

    public function bulkApproveSecondAdmin(array $data);

}