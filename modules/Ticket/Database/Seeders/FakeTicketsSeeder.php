<?php

namespace Modules\Ticket\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ticket\App\Models\Ticket;

class FakeTicketsSeeder extends Seeder
{
    public function run(): void
    {
        Ticket::factory()->count(25)->create();
    }
}
