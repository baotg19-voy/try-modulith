<?php

namespace Modules\Product\App\Repositories\Category;

use Modules\Core\App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return \Modules\Product\App\Models\Category::class;
    }

    public function getPaginated(int $perPage)
    {
        return $this->model->orderBy('id', 'desc')->paginate($perPage);
    }
}
