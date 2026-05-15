<?php

namespace Modules\User\App\Adapters;

use Modules\User\App\Dtos\TokenDto;
use Modules\User\App\Models\User;

interface UserTokenAdapterInterface
{

    public function fromUserToTokenDto(User $user, string $token): TokenDto;

}