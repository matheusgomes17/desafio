<?php

namespace App\Repositories;

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
}