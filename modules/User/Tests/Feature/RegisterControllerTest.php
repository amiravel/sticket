<?php

namespace Modules\User\Tests\Feature;

use Tests\TestCase;

class RegisterControllerTest extends TestCase
{

    protected string $baseRoute = '/user/api';

    public function testRegister()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => 'Password@123',
            'password_confirmation' => 'Password@123',
        ];

        $this->assertDatabaseCount('users', 0);

        $this->postJson($this->route('/register'), $data)
            ->assertOk();

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
            'name' => $data['name'],
        ]);

        $this->assertDatabaseCount('users', 1);

    }

    public function testRegisterValidationFails()
    {
        $this->assertDatabaseCount('users', 0);

        $this->postJson($this->route('/register'), [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'name',
                'email',
                'password',
            ]);

        $this->assertDatabaseCount('users', 0);
    }

    public function testRegisterInvalidEmailFails()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'not-an-email',
            'password' => 'Password@123',
            'password_confirmation' => 'Password@123',
        ];

        $this->postJson($this->route('/register'), $data)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);

        $this->assertDatabaseCount('users', 0);
    }

    public function testRegisterWeakPasswordFails()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => '123',
            'password_confirmation' => '123',
        ];

        $this->postJson($this->route('/register'), $data)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);

        $this->assertDatabaseCount('users', 0);
    }

    public function testRegisterPasswordConfirmationMismatch()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => 'Password@123',
            'password_confirmation' => 'WrongPassword@123',
        ];

        $this->postJson($this->route('/register'), $data)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['password']);

        $this->assertDatabaseCount('users', 0);
    }

}