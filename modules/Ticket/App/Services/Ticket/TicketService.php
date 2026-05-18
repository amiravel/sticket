<?php

namespace Modules\Ticket\App\Services\Ticket;

use App\Services\BaseCrudService;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Modules\Ticket\App\Enums\TicketStatusEnum;
use Modules\Ticket\App\Jobs\SendToThirdPartyJob;
use Modules\Ticket\App\Notifications\TicketUpdateNotification;
use Modules\Ticket\App\Repositories\Reply\ReplyRepositoryInterface;
use Modules\Ticket\App\Repositories\Ticket\TicketRepositoryInterface;

class TicketService extends BaseCrudService implements TicketServiceInterface
{

    protected ReplyRepositoryInterface $replyRepository;
    public function __construct(
        TicketRepositoryInterface $repository,
    )
    {
        parent::__construct($repository);
        $this->replyRepository = App::make(ReplyRepositoryInterface::class);
    }

    public function create(array $data)
    {
        $data['file'] = $data['file']->storePublicly();

        return parent::create($data);
    }

    /**
     * @throws \Throwable
     */
    public function update(int $id, array $data): void
    {
        DB::transaction(function () use ($id, $data) {

            $this->repository->update($id, Arr::only($data, ['status']));

            $this->replyRepository->create(Arr::only($data, ['user_id', 'ticket_id', 'description']));

        });

        Notification::send(
            $this->repository->find($id)->user,
            new TicketUpdateNotification()
        );
    }

    public function bulkApproveSecondAdmin(array $data)
    {
        $this->repository->bulkUpdate(
            $data['ids'],
            ['status' => TicketStatusEnum::approved_2->value]
        );

        SendToThirdPartyJob::dispatch($data['ids']);

        $this->bulkReply($data);
    }
    public function bulkApprove(array $data)
    {
        $this->repository->bulkUpdate(
            $data['ids'],
            ['status' => TicketStatusEnum::approved_1->value]
        );

        $this->bulkReply($data);
    }

    public function bulkReply(array $data): void
    {
        $replies = [];

        foreach ($data['ids'] as $id) {
            $replies[] = [
                'user_id' => $data['user_id'],
                'ticket_id' => $id,
                'description' => $data['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $this->replyRepository->bulkCreate($replies);
    }


}