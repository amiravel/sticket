<?php

namespace Modules\User\App\Filters\Users;

use App\Filters\BaseFilters;

class UsersFilter extends BaseFilters implements UsersFilterInterface
{

    protected array $filters = [
        'ids_in'
    ];

    public function ids_in(array $ids): static
    {
        $this->query->whereIn('id', $ids);
    }
}