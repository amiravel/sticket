<?php

namespace Modules\Ticket\Tests\Features\Admin;

use Modules\Ticket\App\Models\Ticket;
use Modules\User\App\Models\User;
use Modules\User\Enums\RolesEnum;
use Tests\TestCase;

class AdminTicketControllerTest extends TestCase
{

    protected string $baseRoute = 'ticket/api/admin';

    public function testAdminCanSeeTicketList()
    {
        $user = User::factory()->create(['role' => RolesEnum::AdminLevel_1->name]);
        $ticket = Ticket::factory()->create();

        $this->actingAs($user);

        $this->getJson($this->route('/tickets'))
            ->assertOk()
            ->assertJsonFragment([
                'id' => $ticket->id,
                'title' => $ticket->title,
                'description' => $ticket->description,
                'user' => [
                    'id' => $ticket->user->id,
                    'name' => $ticket->user->name,
                    'email' => $ticket->user->email,
                ]
            ]);
    }

    public function testNormalUserCanNotSeeTicketList()
    {
        $user = User::factory()->create(['role' => RolesEnum::User->name]);
        $ticket = Ticket::factory()->create();

        $this->actingAs($user);

        $this->getJson($this->route('/tickets'))
            ->assertUnauthorized();
    }

    public function testAdminUserCanViewTicket()
    {
        $user = User::factory()->create([
            'role' => RolesEnum::AdminLevel_1->name
        ]);

        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        $this->getJson(
            $this->route("/tickets/{$ticket->id}")
        )
            ->assertOk()
            ->assertJsonFragment([
                'id' => $ticket->id,
                'title' => $ticket->title,
                'description' => $ticket->description,
                'status' => $ticket->status->value,
                'user' => [
                    'id' => $ticket->user->id,
                    'name' => $ticket->user->name,
                    'email' => $ticket->user->email,
                ]
            ]);
    }

    public function testGuestCannotViewTicket()
    {
        $ticket = Ticket::factory()->create();

        $this->getJson(
            $this->route("/tickets/{$ticket->id}")
        )->assertUnauthorized();
    }

    public function testShowReturnsNotFound()
    {
        $user = User::factory()->create([
            'role' => RolesEnum::AdminLevel_1->name
        ]);

        $this->actingAs($user);

        $this->getJson(
            $this->route('/tickets/999999')
        )->assertNotFound();
    }

    public function testShowReturnsCorrectStructure()
    {
        $user = User::factory()->create([
            'role' => RolesEnum::AdminLevel_1->name
        ]);

        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        $this->getJson(
            $this->route("/tickets/{$ticket->id}")
        )
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'status',
                    'user' => [
                        'id',
                        'name',
                        'email',
                    ],

                ],
            ]);
    }

}