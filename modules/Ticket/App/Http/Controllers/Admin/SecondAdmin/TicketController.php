<?php

namespace Modules\Ticket\App\Http\Controllers\Admin\SecondAdmin;

use App\Http\Controllers\Controller;
use App\Utils\Response\ResponseInterface;
use Modules\Ticket\App\Enums\TicketStatusEnum;
use Modules\Ticket\App\Http\Requests\TicketUpdateRequest;
use Modules\Ticket\App\Http\Resources\TicketResource;
use Modules\Ticket\App\Services\Ticket\TicketServiceInterface;

class TicketController extends Controller
{

    public function __construct(TicketServiceInterface $service, ResponseInterface $response)
    {
        parent::__construct($service, $response);
    }

    public function index()
    {
        return $this->response->paginate(
            TicketResource::collection(
                $this->service->filter(['status' => TicketStatusEnum::approved_1->value])
                    ->paginate(request()->get('page', 1))
            )
        );
    }

    public function update(TicketUpdateRequest $request, int $id)
    {
        $this->service->update($id, $request->validated());

        return $this->response->ok();
    }

    public function show(int $id)
    {
        return $this->response->item(
            TicketResource::make($this->service->find($id))
        );
    }

}