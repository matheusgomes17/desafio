<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        $data['password'] = app('hash')->make($data['password']);

        return $this->entity->create($data);
    }
}
