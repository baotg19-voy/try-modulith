<?php

namespace Modules\Core\App\Repositories;

use Modules\Core\App\DTO\BaseDTO;

interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param BaseDTO $dto
     * @return mixed
     */
    public function create(BaseDTO $dto);

    /**
     * Update
     * @param $id
     * @param BaseDTO $dto
     * @return mixed
     */
    public function update($id, BaseDTO $dto);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Get pagination
     * @param int $perPage
     * @return mixed
     */
    public function getPaginated(int $perPage);

    /**
     * Get pagination
     * @param array $ids
     * @return \Illuminate\Support\Collection
     */
    public function getByIds(array $ids);
}
