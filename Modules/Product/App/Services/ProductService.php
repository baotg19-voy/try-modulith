<?php
namespace Modules\Product\App\Services;

use Modules\Product\App\DTO\ProductDTO;
use Modules\Product\App\Repositories\Product\ProductRepositoryInterface;
use Modules\Product\App\Repositories\Review\ReviewRepositoryInterface;

class ProductService {
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ReviewRepositoryInterface $reviewRepository,
    ) {}

    public function getPaginatedProducts($perPage = 10)
    {
        return $this->productRepository->getPaginated($perPage);
    }

    public function getAllProducts(){
        return $this->productRepository->getAll();
    }

    public function getProductDictByIds(array $productIds){
        return $this->productRepository
            ->getByIds($productIds)
            ->keyBy('id');
    }

    public function createProduct(ProductDTO $dto)
    {
        return $this->productRepository->create($dto);
    }

    public function updateProduct(int $productId, ProductDTO $dto)
    {
        return $this->productRepository->update($productId, $dto);
    }

    public function deleteProduct(int $productId)
    {
        return $this->productRepository->delete($productId)
        && $this->reviewRepository->deleteByProductId($productId);
    }
}