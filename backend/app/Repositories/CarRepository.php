<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Car;
use App\Repositories\Contracts\CarRepositoryInterface;

class CarRepository implements CarRepositoryInterface
{
    protected $entity;

    public function __construct(Car $user)
    {
        $this->entity = $user;
    }

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        return $this->entity->create($data);
    }
}
