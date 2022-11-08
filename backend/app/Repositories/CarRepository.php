<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Car;
use App\Repositories\Contracts\CarRepositoryInterface;

class CarRepository extends BaseRepository implements CarRepositoryInterface
{
    /**
     * @var \App\Models\Car $entity
     */
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

    /**
     * @param $id
     * @param array $data
     * @return object
     * @throws \Exception
     */
    public function update($id, array $data): object
    {
        $car = $this->findById($id);

        if (! $car) {
            throw new \Exception("O carro com ID {$id} não foi encontrado");
        }

        $car->update($data);

        $car = $this->findById($id);

        return $car;
    }
}
