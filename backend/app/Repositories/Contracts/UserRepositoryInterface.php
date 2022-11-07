<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
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

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool;

    /**
     * @param $id
     * @param array $data
     * @return null
     * @throws \Exception
     */
    public function attach($id, array $data);

    /**
     * @param $id
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function detach($id, array $data): bool;
}
