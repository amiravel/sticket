<?php

namespace Modules\User\Tests\Feature;

use Modules\User\App\Models\User;
use Tests\TestCase;

class LogoutTest extends TestCase
{

    protected string $baseRoute = '/user/api';


    public function testLogout()
    {
        $user = User::factory()->create();

        $token = $user
            ->createToken('auth-token')
            ->plainTextToken;

        $this->assertDatabaseCount(
            'personal_access_tokens',
            1
        );

        $this->withToken($token)
            ->postJson($this->route('/logout'))
            ->assertOk()
            ->assertJson([
                'message' => 'ok',
                'code' => 200
            ]);

        $this->assertDatabaseCount(
            'personal_access_tokens',
            0
        );
    }

    public function testLogoutRequiresAuthentication()
    {
        $this->postJson(
            $this->route('/logout')
        )->assertUnauthorized();
    }
}