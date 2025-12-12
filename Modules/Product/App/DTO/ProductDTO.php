<?php

namespace Modules\Product\App\DTO;

use Illuminate\Http\Request;
use Modules\Core\App\DTO\BaseDTO;

readonly class ProductDTO extends BaseDTO
{
    public function __construct(
        public string $name,
        public ?string $description,
        public string $price,
        public ?string $categoryId
    ) {
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            name: $request->name,
            description: $request->description,
            price: $request->price,
            categoryId: $request->category_id
        );
    }
}
