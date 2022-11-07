<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Cars\StoreRequest;
use App\Http\Resources\V1\CarResource;
use App\Services\CarService;

class CarController extends Controller
{
    /**
     * @var \App\Services\CarService
     */
    private $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * @param \App\Http\Requests\V1\Cars\StoreRequest $request
     * @return \App\Http\Resources\V1\CarResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $car = $this->carService->create($data);

        return (new CarResource($car));
    }
}
