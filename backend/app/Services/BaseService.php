<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseService
{
    protected $repository;

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return $this->repository->all();
    }

    /**
     * @param int $perPage
     * @param array $relationships
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $relationships = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relationships);
    }

    /**
     * @param $id
     * @param array $relationship
     * @return object|null
     */
    public function findById($id, array $relationship = []): ?object
    {
        return $this->repository->findById($id, $relationship);
    }

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        return $this->repository->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return object
     * @throws \Exception
     */
    public function update($id, array $data): object
    {
        return $this->repository->update($id, $data);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        return $this->repository->delete($id);
    }
}
