<?php

namespace Modules\Core\App\Repositories;

use Modules\Core\App\DTO\BaseDTO;
use Modules\Core\App\Repositories\RepositoryInterface;


abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

   //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create(BaseDTO $dto)
    {
        return $this->model->create($dto->toArray());
    }

    public function update($id, BaseDTO $dto)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($dto->toArray());
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function getPaginated(int $perPage)
    {
        return $this->model->paginate($perPage);
    }

    public function getByIds(array $ids)
    {
        if (empty($ids)) {
            return collect();
        }
        
        return $this->model
            ->whereIn('id', $ids)
            ->get();
    }
}
