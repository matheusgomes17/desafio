<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Users\StoreRequest;
use App\Http\Resources\V1\UserResource;
use App\Services\UserService;

class UserController extends Controller
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
     * @param \App\Http\Requests\V1\Users\StoreRequest $request
     * @return \App\Http\Resources\V1\UserResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $user = $this->userService->create($data);

        return (new UserResource($user));
    }
}
