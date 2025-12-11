<?php
namespace Modules\Product\App\Services;

use Modules\Product\App\DTO\ReviewDTO;
use Modules\Product\App\Repositories\Review\ReviewRepositoryInterface;

class ReviewService {
    public function __construct(private ReviewRepositoryInterface $reviewRepository)
    {
    }

    public function getPaginatedReviews($perPage = 10)
    {
        return $this->reviewRepository->getPaginated($perPage);
    }

    public function getAllReviews()
    {
        return $this->reviewRepository->getAll();
    }

    public function createReview(ReviewDTO $dto)
    {
        return $this->reviewRepository->create($dto);
    }

    public function updateReview(string $reviewId, ReviewDTO $dto)
    {
        return $this->reviewRepository->update($reviewId, $dto);
    }

    public function deleteReview(string $reviewId)
    {
        return $this->reviewRepository->delete($reviewId);
    }
}