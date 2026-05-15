<?php

namespace Modules\User\App\Repositories\User;

use App\Repositories\BaseRepository;
use Modules\User\App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

}