<?php

namespace Modules\Ticket\App\Http\Controllers\Admin\FirstAdmin;

use App\Http\Controllers\Controller;
use App\Utils\Response\ResponseInterface;
use Modules\Ticket\App\Http\Requests\BulkTicketApproveRequest;
use Modules\Ticket\App\Services\Ticket\TicketServiceInterface;

class TicketBulkApproveController extends Controller
{
    public function __construct(
        TicketServiceInterface $service,
        ResponseInterface $response
    )
    {
        parent::__construct($service, $response);
    }

    public function update(BulkTicketApproveRequest $request)
    {
        $this->service->bulkApprove($request->validated());

        return $this->response->ok();
    }

}