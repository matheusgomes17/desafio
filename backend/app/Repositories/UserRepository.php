<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @return string
     */
    public function entity()
    {
        return User::class;
    }

    /**
     * @param $id
     * @param array $data
     * @return null
     */
    public function attachCar($id, array $data)
    {
        $user = $this->findById($id, ['cars']);

        return $user->cars()->attach($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return bool
     */
    public function detachCar($id, array $data): bool
    {
        $user = $this->findById($id, ['cars']);

        return (bool) $user->cars()->detach($data);
    }
}
