<?php

namespace Modules\User\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Utils\Response\ResponseInterface;
use Illuminate\Http\Request;
use Modules\User\App\Http\Requests\LoginRequest;
use Modules\User\App\Services\Auth\AuthServiceInterface;

class LoginController extends Controller
{

    public function __construct(AuthServiceInterface $service, ResponseInterface $response)
    {
        parent::__construct($service, $response);
    }

    public function store(LoginRequest $request)
    {
        return $this->response->item(
            $this->service->login($request)->toArray()
        );
    }

    public function destroy(Request $request)
    {
        $this->service->logout($request->user());

        return $this->response->ok();
    }

}