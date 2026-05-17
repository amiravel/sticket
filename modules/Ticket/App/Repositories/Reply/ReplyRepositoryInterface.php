<?php

namespace Modules\Ticket\App\Repositories\Reply;

use App\Repositories\BaseRepositoryInterface;

interface ReplyRepositoryInterface extends BaseRepositoryInterface
{

    public function bulkCreate(array $data): void;

}