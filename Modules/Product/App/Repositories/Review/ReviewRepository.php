<?php

namespace Modules\Product\App\Repositories\Review;

use Modules\Core\App\DTO\BaseDTO;
use Modules\Core\App\Repositories\BaseRepository;
use Modules\Product\App\DTO\ReviewDTO;
use Modules\Product\App\Models\Review;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function getModel()
    {
        return \Modules\Product\App\Models\Review::class;
    }

    public function create(BaseDTO $dto)
    {
        /** @var ReviewDTO $reviewDto */
        $reviewDto = $dto;

        $reviewData = [
            'author_name' => $reviewDto->authorName,
            'product_id' => $reviewDto->productId,
            'rating' => $reviewDto->rating,
            'comment' => $reviewDto->comment
        ];

        return $this->model->create($reviewData);
    }

    public function update($id, BaseDTO $dto)
    {
        /** @var ReviewDTO $reviewDto */
        $reviewDto = $dto;

        $reviewData = [
            'author_name' => $reviewDto->authorName,
            'product_id' => $reviewDto->productId,
            'rating' => $reviewDto->rating,
            'comment' => $reviewDto->comment
        ];

        $result = $this->find($id);
        if ($result) {
            $result->update($reviewData);
            return $result;
        }

        return false;
    }

    public function getPaginated(int $perPage)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function deleteByProductId(int $productId)
    {
        return $this->model->whereProductId($productId)->delete();
    }
}
