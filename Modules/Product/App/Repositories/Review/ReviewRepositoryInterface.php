<?php
namespace Modules\Product\App\Repositories\Review;

use Modules\Core\App\Repositories\RepositoryInterface;


interface ReviewRepositoryInterface extends RepositoryInterface
{
    public function deleteByProductId(string $productId);
}
