<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CarRepositoryInterface
{
    /**
     * @param $id
     * @param array $relationship
     * @return object|null
     */
    public function findById($id, array $relationship = []): ?object;

    /**
     * @param int $perPage
     * @param array $relationships
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $relationships = []): LengthAwarePaginator;

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object;

    /**
     * @param $id
     * @param array $data
     * @return object
     * @throws \Exception
     */
    public function update($id, array $data): object;

    /**
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id): bool;
}
