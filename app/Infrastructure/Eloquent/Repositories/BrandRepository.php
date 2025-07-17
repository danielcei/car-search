<?php
namespace App\Infrastructure\Eloquent\Repositories;

use App\Domain\Cars\Repositories\BrandRepositoryInterface;
use App\Application\Services\CacheService;
use App\Models\Brand;
use \Illuminate\Support\Collection;

class BrandRepository implements BrandRepositoryInterface
{
    public function __construct(
        private CacheService $cache
    ) {}

    public function getAllCached(): Collection
    {
        return $this->cache->remember(
            'all-brands',
            now()->addDay(),
            fn() => Brand::orderBy('name')->get()
        );
    }
}
