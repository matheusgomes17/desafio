<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
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
     * @param array $relationships
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $relationships = []): LengthAwarePaginator
    {
        return $this->entity->with($relationships)->paginate($perPage);
    }
}