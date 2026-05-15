<?php

namespace Modules\User\App\Http\Controllers;

use \App\Http\Controllers\Controller as BaseController;
use App\Utils\Response\ResponseInterface;
use Modules\User\App\Http\Requests\RegisterRequest;
use Modules\User\App\Services\User\UserServiceInterface;

class RegisterController extends BaseController
{

    public function __construct(UserServiceInterface $service, ResponseInterface $response)
    {
        parent::__construct($service, $response);
    }

    public function store(RegisterRequest $request)
    {
        $this->service->create($request->validated());

        return $this->response->ok();
    }

}