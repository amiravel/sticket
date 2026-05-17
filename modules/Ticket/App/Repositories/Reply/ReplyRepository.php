<?php

namespace Modules\Ticket\App\Repositories\Reply;

use App\Repositories\BaseRepository;
use Modules\Ticket\App\Models\Reply;

class ReplyRepository extends BaseRepository implements ReplyRepositoryInterface
{

    public function __construct(Reply $model)
    {
        parent::__construct($model);
    }

    public function bulkCreate(array $data): void
    {
        $this->query->insert($data);
    }
}