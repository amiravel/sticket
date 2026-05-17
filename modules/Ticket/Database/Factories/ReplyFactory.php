<?php

namespace Modules\Ticket\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ticket\App\Models\Reply;
use Modules\Ticket\App\Models\Ticket;
use Modules\User\App\Models\User;

class ReplyFactory extends Factory
{

    protected $model = Reply::class;

    public function definition(): array
    {
        return [
            'ticket_id' => Ticket::factory()->create()->id,
            'user_id' => User::factory()->create(),
            'description' => $this->faker->paragraph(),
        ];
    }
}