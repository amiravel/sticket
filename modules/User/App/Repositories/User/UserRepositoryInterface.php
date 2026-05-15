<?php

namespace Modules\User\App\Repositories\User;

use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{

    public function findByEmail($email): \Illuminate\Database\Eloquent\Model;

}