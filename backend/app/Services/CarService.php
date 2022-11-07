<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\CarRepositoryInterface;

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
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        return $this->carRepository->create($data);
    }
}
