<?php
namespace Modules\Product\App\DTO;

use Illuminate\Http\Request;
use Modules\Core\App\DTO\BaseDTO;

readonly class ReviewDTO extends BaseDTO {
    public function __construct(
        public int $productId,
        public string $authorName,
        public int $rating,
        public string $comment
    ) {}

    public static function fromRequest(Request $request)
    {
        return new self(
            productId: $request->product_id,
            authorName: $request->author_name,
            rating: $request->rating,
            comment: $request->comment
        );
    }
}