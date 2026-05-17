<?php

namespace Modules\User\App\Services\Auth;

use Illuminate\Support\Facades\Hash;
use Modules\User\App\Adapters\UserTokenAdapterInterface;
use Modules\User\App\Dtos\TokenDto;
use Modules\User\App\Models\User;
use Modules\User\App\Repositories\User\UserRepositoryInterface;

class AuthService implements AuthServiceInterface
{

    public function __construct(
        protected UserRepositoryInterface $repository,
        protected UserTokenAdapterInterface $adapter
    )
    {
    }

    public function login($data): TokenDto
    {
        $user = $this->repository->findByEmail($data['email']);

        if (! Hash::check($data['password'], $user->password)) {
            abort(401, 'Invalid credentials');
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return $this->adapter->fromUserToTokenDto($user, $token);
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }
}