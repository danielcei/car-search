<?php
namespace App\Infrastructure\Eloquent\Repositories;

use App\Domain\Cars\DTOs\CarSearchFilter;
use App\Domain\Cars\Repositories\CarRepositoryInterface;
use App\Models\Car;
use Illuminate\Contracts\Pagination\Paginator;
class CarRepository implements CarRepositoryInterface
{
    public function search(CarSearchFilter $filter): Paginator
    {
        return Car::query()
            ->when($filter->search, fn($q) => $q->where('name', 'like', "%{$filter->search}%"))
            ->when($filter->brandIds, fn($q) => $q->whereIn('brand_id', $filter->brandIds))
            ->when($filter->categoryIds, fn($q) => $q->whereIn('category_id', $filter->categoryIds))
            ->with(['brand', 'category'])
            ->orderByDesc('id')
            ->paginate($filter->perPage);
    }
}
