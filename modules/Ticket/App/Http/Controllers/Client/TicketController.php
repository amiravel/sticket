<?php

namespace Modules\Ticket\App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Utils\Response\ResponseInterface;
use Modules\Ticket\App\Http\Requests\TicketStoreRequest;
use Modules\Ticket\App\Services\Ticket\TicketServiceInterface;

class TicketController extends Controller
{

    public function __construct(TicketServiceInterface $service, ResponseInterface $response)
    {
        parent::__construct($service, $response);
    }


    public function store(TicketStoreRequest $request)
    {
        $this->service->create($request->validated());

        return $this->response->ok();
    }

}