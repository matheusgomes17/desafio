<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\CarRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CarService
{
    /**
     * @var \App\Repositories\Contracts\UserRepositoryInterface
     */
    private $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @param $id
     * @param array $relationship
     * @return object|null
     */
    public function findById($id, array $relationship = []): ?object
    {
        return $this->carRepository->findById($id, $relationship);
    }

    /**
     * @param int $perPage
     * @param array $relationships
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $relationships = []): LengthAwarePaginator
    {
        return $this->carRepository->paginate($perPage, $relationships);
    }

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        return $this->carRepository->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return object
     * @throws \Exception
     */
    public function update($id, array $data): object
    {
        return $this->carRepository->update($id, $data);
    }
}
