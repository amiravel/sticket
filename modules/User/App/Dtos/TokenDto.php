<?php

namespace Modules\User\App\Dtos;

class TokenDto
{

    public function __construct(
        public int $id,
        public string $email,
        public string $token,
    )
    {
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'token' => $this->token,
        ];
    }

}