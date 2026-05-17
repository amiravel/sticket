<?php

namespace Modules\Ticket\Tests\Features\Client;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Ticket\App\Models\Ticket;
use Modules\User\App\Models\User;
use Tests\TestCase;

class TicketControllerTest extends TestCase
{

    protected string $baseRoute = '/ticket/api';

    public function testStore()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $this->actingAs($user);

        $ticketData = Ticket::factory()->make(['user_id' => $user->id])->toArray();

        $ticketData['file'] = UploadedFile::fake()->image('ticket.jpg');


        $this->assertDatabaseCount('tickets', 0);


        $this->postJson($this->route('/tickets'), $ticketData)
            ->assertOk();

        $this->assertDatabaseHas('tickets', $ticketData);

        $this->assertDatabaseCount('tickets', 1);
    }

    public function testStoreValidationFails()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->postJson($this->route('/tickets'), [])
            ->assertUnprocessable();

        $this->assertDatabaseCount('tickets', 0);
    }

    public function testStoreInvalidStatusFails()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $ticketData = Ticket::factory()
            ->make(['user_id' => $user->id])
            ->toArray();

        $ticketData['status'] = 'invalid-status';

        $ticketData['file'] = UploadedFile::fake()->image('ticket.jpg');


        $this->postJson($this->route('/tickets'), $ticketData)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['status']);

        $this->assertDatabaseCount('tickets', 0);
    }

    public function testStoreInvalidFileTypeFails()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $ticketData = Ticket::factory()
            ->make(['user_id' => $user->id])
            ->toArray();

        $ticketData['file'] = UploadedFile::fake()
            ->create('ticket.exe', 100);


        $this->postJson($this->route('/tickets'), $ticketData)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['file']);

        $this->assertDatabaseCount('tickets', 0);
    }

    public function testStoreRequiresAuthentication()
    {
        $ticketData = Ticket::factory()->make()->toArray();

        $ticketData['file'] = UploadedFile::fake()->image('ticket.jpg');

        $this->postJson($this->route('/tickets'), $ticketData)
            ->assertUnauthorized();

        $this->assertDatabaseCount('tickets', 0);
    }

}