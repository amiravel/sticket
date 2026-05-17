<?php

namespace Modules\Ticket\App\Facades;

use App\Utils\Response\ResponseInterface;

class ThirdParty
{

    public function __construct(
        protected ResponseInterface $response
    )
    {
    }

    public function respond()
    {
        $responses = [
            0 => "success",
            1 => "failure",
        ];

        $randomItem = $responses[array_rand($responses)];

        return $this->{$randomItem}();

    }

    public function success()
    {
        return $this->response->ok();
    }

    public function failure()
    {
        return $this->response->error("service call failed!", 500);
    }

}