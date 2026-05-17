<?php

namespace Modules\Ticket\Tests\Features\Admin;

use Modules\Ticket\App\Enums\TicketStatusEnum;
use Modules\Ticket\App\Models\Ticket;
use Modules\User\App\Models\User;
use Modules\User\Enums\RolesEnum;
use Tests\TestCase;

class TicketApproveTest extends TestCase
{

    protected string $baseRoute = 'ticket/api/admin';

    public function testUpdateTicket()
    {
        $user = User::factory()->create();

        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
        ]);

        $data = [
            'status' => TicketStatusEnum::approved_1->value,
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'description' => 'Ticket approved',
        ];

        $admin = User::factory()->create([
            'role' => RolesEnum::AdminLevel_1->name,
        ]);

        $this->actingAs($admin);

        $this->assertDatabaseCount('replies', 0);

        $this->patchJson(
            $this->route("/tickets/{$ticket->id}"),
            $data
        )->assertOk();

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'status' => TicketStatusEnum::approved_1->value,
        ]);

        $this->assertDatabaseHas('replies', [
            'user_id' => $admin->id,
            'ticket_id' => $ticket->id,
            'description' => 'Ticket approved',
        ]);

        $this->assertDatabaseCount('replies', 1);
    }

    public function testGuestCannotUpdateTicket()
    {
        $ticket = Ticket::factory()->create();

        $data = [
            'status' => TicketStatusEnum::approved_1->value,
            'user_id' => 1,
            'ticket_id' => $ticket->id,
            'description' => 'Approved',
        ];

        $this->patchJson(
            $this->route("/tickets/{$ticket->id}"),
            $data
        )->assertUnauthorized();
    }

    public function testUpdateValidationFails()
    {
        $user = User::factory()->create([
            'role' => RolesEnum::AdminLevel_1->name,
        ]);

        $this->actingAs($user);

        $this->patchJson(
            $this->route("/tickets/11111"),
            []
        )
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'ticket_id',
            ]);
    }

    public function testUpdateFailsWithInvalidStatus()
    {
        $user = User::factory()->create([
            'role' => RolesEnum::AdminLevel_1->name,
        ]);

        $this->actingAs($user);

        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
        ]);

        $data = [
            'status' => 'not-real',
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'description' => 'Invalid',
        ];

        $this->patchJson(
            $this->route("/tickets/{$ticket->id}"),
            $data
        )
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'status'
            ]);
    }
}