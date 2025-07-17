<?php

namespace App\Domain\Cars\DTOs;

class CarSearchFilter
{
    public function __construct(
        public ?string $search = null,
        public ?array  $brandIds = null,
        public ?array  $categoryIds = null,
        public int     $perPage = 12
    )
    {
    }
}
