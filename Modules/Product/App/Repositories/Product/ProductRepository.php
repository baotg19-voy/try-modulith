<?php
namespace Modules\Product\App\Repositories\Product;

use Illuminate\Support\Collection;
use Modules\Core\App\DTO\BaseDTO;
use Modules\Core\App\Repositories\BaseRepository;
use Modules\Product\App\DTO\ProductDTO;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface 
{
    public function getModel()
    {
        return \Modules\Product\App\Models\Product::class;
    }

    public function getPaginated(int $perPage)
    {
        return $this->model->orderBy('id', 'desc')->with('category')->paginate($perPage);
    }

    public function create(BaseDTO $dto)
    {
        /** @var ProductDTO $productDto */
        $productDto = $dto;
        
        $productData = [
            'name' => $productDto->name,
            'description' => $productDto->description,
            'price' => $productDto->price,
            'category_id' => $productDto->categoryId
        ];

        return $this->model->create($productData);
    }

    public function update($id, BaseDTO $dto)
    {
        /** @var ProductDTO $productDto */
        $productDto = $dto;
        
        $productData = [
            'name' => $productDto->name,
            'description' => $productDto->description,
            'price' => $productDto->price,
            'category_id' => $productDto->categoryId
        ];

        $result = $this->find($id);
        if ($result) {
            $result->update($productData);
            return $result;
        }

        return false;
    }
}