<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Cars\StoreRequest;
use App\Http\Requests\V1\Cars\UpdateRequest;
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all()
    {
        $cars = $this->carService->all();

        return response()->json([
            'data' => $cars->pluck('name', 'id')
        ]);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $cars = $this->carService->paginate(20);

        return CarResource::collection($cars);
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

    /**
     * @param $id
     * @return \App\Http\Resources\V1\CarResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if (! $car = $this->carService->findById($id)) {
            return response()->json([
                'message' => 'O carro não foi encontrado'
            ], 404);
        }

        return (new CarResource($car));
    }

    /**
     * @param $id
     * @param \App\Http\Requests\V1\Cars\UpdateRequest $request
     * @return \App\Http\Resources\V1\CarResource|\Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateRequest $request)
    {
        $data = $request->validated();

        try {
            $car = $this->carService->update($id, $data);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 404);
        }

        return (new CarResource($car));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->carService->delete($id);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 404);
        }

        if (! $deleted) {
            return response()->json([
                'message' => 'Erro ao deletar o carro'
            ], 422);
        }

        return response()->json([], 204);
    }
}
