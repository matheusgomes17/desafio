<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\UserNotFound;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->entity->with(['cars'])->paginate($perPage);
    }

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        $data['password'] = $this->generateHash($data['password']);

        return $this->entity->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return object
     * @throws \App\Exceptions\UserNotFound
     */
    public function updateProfile($id, array $data): object
    {
        $user = $this->findById($id);

        if (! $user) {
            throw new UserNotFound();
        }

        $data['password'] = $this->generateHash($data['password']);

        if (! $user->update($data)) {
            throw new \Exception('Houve um erro ao atualizar o usuário');
        }

        $user = $this->findById($id);

        return $user;
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
            throw new UserNotFound();
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
            throw new UserNotFound();
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
            throw new UserNotFound();
        }

        return (bool) $user->cars()->detach($data);
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
