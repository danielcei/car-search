<?php

namespace App\Domain\Cars\UseCases;

use App\Domain\Cars\DTOs\CarSearchFilter;
use App\Domain\Cars\Repositories\CarRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class SearchCars
{
    public function __construct(
        private CarRepositoryInterface $repository
    ) {}

    public function execute(CarSearchFilter $filter): Paginator
    {
        $cacheKey = $this->getCacheKey($filter);

        return $this->repository->search($filter);
    }

    private function getCacheKey(CarSearchFilter $filter): string
    {
        return 'car-search:' . md5(json_encode([
                'search' => $filter->search,
                'brands' => $filter->brandIds ? implode(',', $filter->brandIds) : null,
                'categories' => $filter->categoryIds ? implode(',', $filter->categoryIds) : null,
                'page' => request('page', 1),
            ]));
    }
}
