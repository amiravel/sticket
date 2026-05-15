<?php

namespace Modules\User\App\Services\Auth;

interface AuthServiceInterface
{

    public function login($data);

    public function logout(int $id);

}