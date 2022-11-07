<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    /**
     * @var \App\Repositories\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        return $this->userRepository->create($data);
    }
}
