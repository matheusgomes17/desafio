<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface CarRepositoryInterface
{
    /**
     * @param $id
     * @param array $relationship
     * @return object|null
     */
    public function findById($id, array $relationship = []): ?object;

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object;
}
