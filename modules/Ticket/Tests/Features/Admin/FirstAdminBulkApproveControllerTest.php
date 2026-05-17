<?php

namespace Modules\Ticket\Tests\Features\Admin;

use Modules\Ticket\App\Enums\TicketStatusEnum;
use Modules\Ticket\App\Models\Ticket;
use Modules\User\App\Models\User;
use Modules\User\Enums\RolesEnum;
use Tests\TestCase;

class FirstAdminBulkApproveControllerTest extends TestCase
{

    protected string $baseRoute = 'ticket/api/admin';

    public function testItBulkApprovesTicketsAndCreatesReplies(): void
    {
        $user = User::factory()->create([
            'role' => RolesEnum::AdminLevel_1->name
        ]);

        $this->actingAs($user);

        $tickets = Ticket::factory()->count(3)->create([
            'status' => 'pending',
        ]);

        $data = [
            'ids' => $tickets->pluck('id')->toArray(),
            'description' => 'Approved in bulk',
        ];


        $this->patchJson($this->route('/tickets/bulk-approve'), $data)
            ->assertOk();

        foreach ($tickets as $ticket) {
            $this->assertDatabaseHas('tickets', [
                'id' => $ticket->id,
                'status' => TicketStatusEnum::approved_1->value,
            ]);

            $this->assertDatabaseHas('replies', [
                'ticket_id' => $ticket->id,
                'user_id' => $user->id,
                'description' => 'Approved in bulk',
            ]);
        }
    }

    public function testValidationFailsIfIdsAreMissing(): void
    {
        $user = User::factory()->create([
            'role' => RolesEnum::AdminLevel_1->name
        ]);

        $this->actingAs($user);


        $this->patchJson($this->route('/tickets/bulk-approve'), [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['ids']);
    }

    public function testDescriptionCanBeNull(): void
    {
        $user = User::factory()->create([
            'role' => RolesEnum::AdminLevel_1->name
        ]);

        $this->actingAs($user);

        $ticket = Ticket::factory()->create();

        $this->patchJson($this->route('/tickets/bulk-approve'), [
            'ids' => [$ticket->id],
            'user_id' => $user->id,
            'description' => null,
        ])->assertOk();

        $this->assertDatabaseHas('replies', [
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'description' => null,
        ]);
    }

    public function testValidationFailsForInvalidTicketIds(): void
    {
        $user = User::factory()->create([
            'role' => RolesEnum::AdminLevel_1->name
        ]);

        $this->actingAs($user);

        $this->patchJson($this->route('/tickets/bulk-approve'), [
            'ids' => [999999],
            'user_id' => $user->id,
        ])->assertStatus(422)
        ->assertJsonValidationErrors(['ids.0']);
    }

    public function testTicketApproveFailsForNotAdminUser(): void
    {
        $user = User::factory()->create([
            'role' => RolesEnum::User->name
        ]);

        $this->actingAs($user);

        $ticket = Ticket::factory()->create();

        $this->patchJson($this->route('/tickets/bulk-approve'), [
            'ids' => [$ticket->id]
        ])->assertStatus(401);
    }

}