<?php

namespace Modules\User\App\Repositories\User;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\App;
use Modules\User\App\Filters\Users\UsersFilterInterface;
use Modules\User\App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->filter = App::make(UsersFilterInterface::class);
    }

    public function findByEmail($email): \Illuminate\Database\Eloquent\Model
    {
        return $this->query->where('email', $email)
            ->firstOrFail();
    }
}