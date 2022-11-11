<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Car;
use App\Repositories\Contracts\CarRepositoryInterface;

class CarRepository extends BaseRepository implements CarRepositoryInterface
{
    /**
     * @return string
     */
    public function entity()
    {
        return Car::class;
    }
}
