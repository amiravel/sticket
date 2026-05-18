<?php

namespace Modules\User\App\Filters\Users;

use App\Filters\BaseFiltersInterface;

interface UsersFilterInterface extends BaseFiltersInterface
{

    public function ids_in(array $ids): static;

}