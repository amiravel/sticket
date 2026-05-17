<?php

namespace Modules\Ticket\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Modules\Ticket\App\Facades\ThirdPartyFacade;
use Modules\Ticket\App\Repositories\Log\LogRepositoryInterface;

class SendToThirdPartyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 60;
    public int $tries = 3;

    public array $backoff = [ 1 * 60 * 60 ]; // 1 hour

    protected LogRepositoryInterface $logRepository;

    public function __construct(public array $ticketIds)
    {
        $this->logRepository = App::make(LogRepositoryInterface::class);
    }

    public function handle(): void
    {
        $response = ThirdPartyFacade::respond();

        $this->logRepository->create([
            'action' => '',
            'data' => json_encode($this->ticketIds),
            'response' => $response->getData(),
        ]);

        if($response->getData()->error){
            abort(500, $response->getData()->message);
        }
    }
}
