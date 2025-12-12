<?php

namespace Modules\Product\App\DTO;

use Modules\Core\App\DTO\BaseDTO;

readonly class CategoryDTO extends BaseDTO
{
    public function __construct(
        public string $name,
        public ?string $slug
    ) {
    }
}
