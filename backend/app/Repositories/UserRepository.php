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

    /**
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id): bool
    {
        $user = $this->entity->find($id);

        if (! $user) {
            throw new \Exception("Usuário com ID {$id} não foi encontrado");
        }

        return $user->delete();
    }
}
