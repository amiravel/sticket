<?php

namespace Modules\Ticket\App\Repositories\Log;

use App\Repositories\BaseRepository;
use Modules\Ticket\App\Models\Log;


class LogRepository extends BaseRepository implements LogRepositoryInterface
{

    public function __construct(Log $model)
    {
        parent::__construct($model);
    }

}