<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var \App\Models\User $entity
     */
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    /**
     * @param $id
     * @param array $relationship
     * @return object|null
     */
    public function findById($id, array $relationship = []): ?object
    {
        $entity = $this->entity;

        if (count($relationship) > 0) {
            $entity = $entity->with($relationship);
        }

        return $entity->find($id);
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
        $user = $this->findById($id);

        if (! $user) {
            throw new \Exception("Usuário com ID {$id} não foi encontrado");
        }

        return $user->delete();
    }

    /**
     * @param $id
     * @param array $data
     * @return null
     * @throws \Exception
     */
    public function attach($id, array $data)
    {
        $user = $this->findById($id, ['cars']);

        if (! $user) {
            throw new \Exception("Usuário com ID {$id} não foi encontrado");
        }

        return $user->cars()->attach($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function detach($id, array $data): bool
    {
        $user = $this->findById($id, ['cars']);

        if (! $user) {
            throw new \Exception("Usuário com ID {$id} não foi encontrado");
        }

        return (bool) $user->cars()->detach($data);
    }
}
