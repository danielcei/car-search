<?php
namespace App\Application\Services;

use App\Domain\Cars\DTOs\CarSearchFilter;

class CarSearchCacheKeyGenerator
{
    public function generate(CarSearchFilter $filter, int $page = 1): string
    {
        $data = [
            'search' => $filter->search,
            'brands' => $filter->brandIds,
            'categories' => $filter->categoryIds,
            'page' => $page,
        ];

        return 'car-search:' . md5(serialize($data));
    }
}
