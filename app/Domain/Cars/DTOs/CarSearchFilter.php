<?php

namespace App\Domain\Cars\DTOs;

use InvalidArgumentException;

class CarSearchFilter
{
    public function __construct(
        public ?string $search = null,
        public ?array  $brandIds = null,
        public ?array  $categoryIds = null,
        public int     $perPage = 12
    )
    {
        if (!$this->isIntegerArray($brandIds)) {
            throw new InvalidArgumentException('Brands invalids.');
        }

        if (!$this->isIntegerArray($categoryIds)) {
            throw new InvalidArgumentException('Categories invalids.');
        }
    }

    private function isIntegerArray(array $array): bool
    {
        foreach ($array as $item) {
            if (!filter_var($item, FILTER_VALIDATE_INT)) {
                return false;
            }
        }
        return true;
    }
}
