<?php
namespace App\Infrastructure\Eloquent\Repositories;

use App\Application\Services\CacheService;
use App\Domain\Categories\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        private CacheService $cache
    ) {}

    public function getAllCached(): Collection
    {
        $cacheKey = 'categories_all';

        return $this->cache->remember($cacheKey, now()->addMinutes(60), function () {
            return Category::whereHas('cars')->orderBy('name')->get();
        });
    }
}
