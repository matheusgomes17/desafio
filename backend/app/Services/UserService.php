<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserService extends BaseService
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        $data['password'] = $this->generateHash($data['password']);

        return parent::create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return object
     * @throws \Exception
     */
    public function update($id, array $data): object
    {
        $data['password'] = $this->generateHash($data['password']);

        return parent::update($id, $data);
    }

    /**
     * @param $id
     * @param array $data
     * @return null
     */
    public function attach($id, array $data)
    {
        return $this->repository->attachCar($id, $data);
    }

    /**
     * @param $id
     * @param array $data
     * @return bool
     */
    public function detach($id, array $data): bool
    {
        return $this->repository->detachCar($id, $data);
    }

    /**
     * @param $value
     * @return string
     */
    private function generateHash($value): string
    {
        return app('hash')->make($value);
    }
}
