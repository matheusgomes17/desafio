<?php

namespace App\Repositories;

use Illuminate\Container\Container;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var \Illuminate\Container\Container
     */
    private $app;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $entity;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->makeEntity();
    }

    /**
     * @return string
     */
    abstract public function entity();

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Exception
     */
    public function makeEntity()
    {
        $entity = $this->app->make($this->entity());

        if (! $entity instanceof Model) {
            throw new \Exception("Class {$this->entity()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->entity = $entity;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return $this->entity->all();
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

        return $entity->findOrFail($id);
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

    /**
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        return $this->entity->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return object
     * @throws \Exception
     */
    public function update($id, array $data): object
    {
        $entity = $this->findById($id);

        if (! $entity->update($data)) {
            throw new \Exception('Houve um erro ao atualizar ');
        }

        return $this->findById($id);
    }

    /**
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id): bool
    {
        $user = $this->findById($id);

        return $user->delete();
    }
}
