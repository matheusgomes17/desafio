<?php

declare(strict_types=1);

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

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        return $this->userRepository->delete($id);
    }
}
