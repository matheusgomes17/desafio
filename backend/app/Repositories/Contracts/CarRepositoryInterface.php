<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface CarRepositoryInterface
{
    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object;
}
