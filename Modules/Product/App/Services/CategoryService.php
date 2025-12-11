<?php
namespace Modules\Product\App\Services;

use Modules\Product\App\DTO\CategoryDTO;
use Modules\Product\App\Repositories\Category\CategoryRepositoryInterface;

class CategoryService {
    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function getPaginatedCategories($perPage = 10)
    {
        return $this->categoryRepository->getPaginated($perPage);
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAll();
    }

    public function createCategory(CategoryDTO $dto)
    {
        return $this->categoryRepository->create($dto);
    }

    public function updateCategory(int $categoryId, CategoryDTO $dto)
    {
        return $this->categoryRepository->update($categoryId, $dto);
    }

    public function deleteCategory(int $categoryId)
    {
        return $this->categoryRepository->delete($categoryId);
    }
}