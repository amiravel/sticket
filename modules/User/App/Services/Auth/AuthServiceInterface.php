<?php

namespace Modules\User\App\Services\Auth;

use Modules\User\App\Dtos\TokenDto;
use Modules\User\App\Models\User;

interface AuthServiceInterface
{

    public function login($data): TokenDto;

    public function logout(User $user): void;

}