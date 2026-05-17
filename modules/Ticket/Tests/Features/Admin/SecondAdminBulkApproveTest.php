<?php

namespace Modules\Ticket\Tests\Features\Admin;

use Illuminate\Support\Facades\Queue;
use Modules\Ticket\App\Enums\TicketStatusEnum;
use Modules\Ticket\App\Jobs\SendToThirdPartyJob;
use Modules\Ticket\App\Models\Ticket;
use Modules\User\App\Models\User;
use Modules\User\Enums\RolesEnum;
use Tests\TestCase;

class SecondAdminBulkApproveTest extends TestCase
{
    protected string $baseRoute = 'ticket/api/admin';

    public function testItBulkApprovesTicketsAndDispatchesThirdPartyJob(): void
    {
        Queue::fake();

        $user = User::factory()->create([
            'role' => RolesEnum::AdminLevel_1->name
        ]);

        $tickets = Ticket::factory()
            ->count(3)
            ->create([
                'status' => TicketStatusEnum::approved_1->value,
            ]);

        $data = [
            'ids' => $tickets->pluck('id')->toArray(),
            'description' => 'Approved by second admin',
        ];

        $this->actingAs($user)
            ->patchJson($this->route('/tickets/bulk-approve/second'), $data)
            ->assertOk();


        Queue::assertPushed(
            SendToThirdPartyJob::class,
            fn ($job) => $job->ticketIds === $tickets->pluck('id')->toArray()
        );

        foreach ($tickets as $ticket) {
            $this->assertDatabaseHas('tickets', [
                'id' => $ticket->id,
                'status' => TicketStatusEnum::approved_2->value,
            ]);

            $this->assertDatabaseHas('replies', [
                'ticket_id' => $ticket->id,
                'user_id' => $user->id,
                'description' => 'Approved by second admin',
            ]);
        }


    }

}
