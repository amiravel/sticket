<?php

namespace App\Services;

use App\Repositories\BaseRepositoryInterface;

abstract class BaseCrudService implements BaseCrudServiceInterface
{

    public function __construct(
        protected BaseRepositoryInterface $repository
    )
    {
    }

    public function paginate(int $page = 1)
    {
        return $this->repository->paginate($page);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}