<?php

namespace App\Services;

interface BaseCrudServiceInterface
{

    public function paginate(int $page = 1);
    public function find(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id): bool;
}