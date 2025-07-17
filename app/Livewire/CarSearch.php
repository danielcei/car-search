<?php

namespace App\Livewire;

use App\Domain\Cars\DTOs\CarSearchFilter;
use App\Domain\Cars\Repositories\BrandRepositoryInterface;
use App\Domain\Cars\Repositories\CategoryRepositoryInterface;
use App\Domain\Cars\UseCases\SearchCars;
use Livewire\Component;
use Livewire\WithPagination;

class CarSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public array $selectedBrands = [];
    public array $selectedCategories = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedBrands' => ['except' => []],
        'selectedCategories' => ['except' => []],
    ];

    public function render(SearchCars                  $searchUseCase,
                           BrandRepositoryInterface    $brandRepo,
                           CategoryRepositoryInterface $categoryRepo)
    {
        $filter = new CarSearchFilter(
            search: $this->search,
            brandIds: $this->selectedBrands,
            categoryIds: $this->selectedCategories,
            perPage: 10
        );

        return view('livewire.car-search', [
            'cars' => $searchUseCase->execute($filter),
            'brands' => $brandRepo->getAllCached(),
            'categories' => $categoryRepo->getAllCached(),
        ]);
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'selectedBrands', 'selectedCategories']);
        $this->resetPage();
    }

    protected function getCacheKey(): string
    {
        return 'car-search:' . md5(serialize([
                $this->search,
                $this->selectedBrands,
                $this->selectedCategories,
                $this->paginators['page'] ?? 1,
            ]));
    }
}
