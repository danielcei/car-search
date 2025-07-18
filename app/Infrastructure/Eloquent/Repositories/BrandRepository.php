<?php
namespace App\Infrastructure\Eloquent\Repositories;

use App\Application\Services\CacheService;
use App\Domain\Brands\Repositories\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Support\Collection;

class BrandRepository implements BrandRepositoryInterface
{
    public function __construct(
        private CacheService $cache
    ) {}

    public function getAllCached(): Collection
    {
        $cacheKey = 'brand_all';

        return $this->cache->remember($cacheKey, now()->addMinutes(60), function () {
            return Brand::whereHas('cars')->orderBy('name')->get();

        });
    }
}
