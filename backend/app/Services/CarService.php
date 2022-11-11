<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\CarRepositoryInterface;

class CarService extends BaseService
{
    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->repository = $carRepository;
    }
}
