<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object;
}
