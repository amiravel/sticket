<?php

namespace Modules\User\App\Services\User;

use App\Services\BaseCrudService;
use Modules\User\App\Repositories\User\UserRepositoryInterface;

class UserService extends BaseCrudService implements UserServiceInterface
{

    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

}