<?php

namespace Modules\User\Tests\Feature;

use Modules\User\App\Models\User;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{

    protected string $baseRoute = '/user/api';

    public function testLogin()
    {

        $user = User::factory()->create([
            'password' => 'password'
        ]);

        $data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $this->postJson($this->route('/login'), $data)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'email',
                    'token',
                ]
            ]);

        $this->assertDatabaseCount('personal_access_tokens', 1);

    }

    public function testLoginFailsWithWrongPassword()
    {
        $user = User::factory()->create([
            'password' => bcrypt('Password@123'),
        ]);

        $data = [
            'email' => $user->email,
            'password' => 'WrongPassword',
        ];

        $this->postJson($this->route('/login'), $data)
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);

        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function testLoginValidationFails()
    {
        $this->postJson($this->route('/login'), [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'email',
                'password',
            ]);
    }

    public function testLoginWithNonExistentEmailFails()
    {
        $data = [
            'email' => 'notfound@gmail.com',
            'password' => 'Password@123',
        ];

        $this->postJson($this->route('/login'), $data)
            ->assertStatus(404);
    }
}