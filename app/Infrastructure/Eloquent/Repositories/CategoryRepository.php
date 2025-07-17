<?php
namespace App\Infrastructure\Eloquent\Repositories;

use App\Application\Services\CacheService;
use App\Domain\Cars\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use \Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        private CacheService $cache
    ) {}

    public function getAllCached(): Collection
    {
        return Category::orderBy('name')->get();
    }
}
