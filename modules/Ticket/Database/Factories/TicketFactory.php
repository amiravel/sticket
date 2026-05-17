<?php

namespace Modules\Ticket\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ticket\App\Enums\TicketStatusEnum;
use Modules\Ticket\App\Models\Ticket;
use Modules\User\App\Models\User;

class TicketFactory extends Factory
{

    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => TicketStatusEnum::pending,
            'file' => $this->faker->imageUrl(),
        ];
    }
}