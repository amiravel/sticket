<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{

    protected Builder $query;

    public function __construct(
        protected Model $model
    ) {
        $this->setQuery();
    }

    public function setQuery(): void
    {
        $this->query = $this->model->newQuery();
    }

    public function paginate(int $page)
    {
        return $this->model->paginate($page);
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $model = $this->find($id);

        $model->update($data);

        return $model;
    }

    public function delete(int $id): bool
    {
        return $this->find($id)->delete();
    }
}