<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\User\App\Models\User;
use Modules\User\Enums\RolesEnum;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'password',
            'role' => RolesEnum::AdminLevel_1->name,
        ]);

        User::create([
            'name' => 'Willem Defoe',
            'email' => 'willem@defoe.com',
            'password' => 'password',
            'role' => RolesEnum::AdminLevel_2->name,
        ]);
    }
}
