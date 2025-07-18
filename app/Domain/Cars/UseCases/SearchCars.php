<?php

namespace App\Domain\Cars\UseCases;

use App\Application\Services\CarSearchCacheKeyGenerator;
use App\Domain\Cars\DTOs\CarSearchFilter;
use App\Domain\Cars\Repositories\CarRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;


class SearchCars
{
    public function __construct(
        private readonly CarRepositoryInterface $repository,
        protected CarSearchCacheKeyGenerator    $cacheKeyGenerator,
    ) {}

    public function execute(CarSearchFilter $filter): Paginator
    {
        $key = $this->cacheKeyGenerator->generate($filter, $filter->perPage ?? 1);

        return Cache::remember($key, now()->addMinutes(10), function () use ($filter) {
            return $this->repository->search($filter);
        });
    }
}
