<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Users\SyncCarRequest;
use App\Services\UserService;

class UserCarController extends Controller
{
    /**
     * @var \App\Services\UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param $id
     * @param \App\Http\Requests\V1\Users\SyncCarRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function attach($id, SyncCarRequest $request)
    {
        $data = $request->validated();

        try {
            $this->userService->attach($id, $data['cars']);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 422);
        }

        return response()->json([
            'message' => 'Carro adicionado com sucesso',
        ]);
    }

    /**
     * @param $id
     * @param \App\Http\Requests\V1\Users\SyncCarRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function detach($id, SyncCarRequest $request)
    {
        $data = $request->validated();

        try {
            $this->userService->detach($id, $data['cars']);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 422);
        }

        return response()->json([
            'message' => 'Carro adicionado com sucesso',
        ]);
    }
}
