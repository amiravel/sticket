<?php

namespace Modules\User\App\Adapters;

use Modules\User\App\Dtos\TokenDto;
use Modules\User\App\Models\User;

class UserTokenAdapter implements UserTokenAdapterInterface
{

    public function fromUserToTokenDto(User $user, string $token): TokenDto
    {
        return new TokenDto(
            $user->id,
            $user->email,
            $token
        );
    }
}