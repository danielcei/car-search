<?php

namespace App\Livewire;

use App\Domain\Brands\Repositories\BrandRepositoryInterface;
use App\Domain\Cars\DTOs\CarSearchFilter;
use App\Domain\Cars\UseCases\SearchCars;
use App\Domain\Categories\Repositories\CategoryRepositoryInterface;
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

    public function render(
        SearchCars $searchUseCase,
        BrandRepositoryInterface $brandRepo,
        CategoryRepositoryInterface $categoryRepo
    ) {
        try {
            $filter = new CarSearchFilter(
                search: $this->search,
                brandIds: $this->selectedBrands,
                categoryIds: $this->selectedCategories,
                perPage: 12
            );

            $cars = $searchUseCase->execute($filter);

            return view('livewire.car-search', [
                'cars' => $cars,
                'brands' => $brandRepo->getAllCached(),
                'categories' => $categoryRepo->getAllCached(),
                'hasResults' => $cars->isNotEmpty(),
            ]);
        } catch (\InvalidArgumentException $e) {
            $this->addError('filters-erros', $e->getMessage());
            return view('livewire.car-search', [
                'cars' => null,
                'brands' => $brandRepo->getAllCached(),
                'categories' => $categoryRepo->getAllCached(),
                'hasResults' => false,
            ]);
        }
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'selectedBrands', 'selectedCategories']);
        $this->resetPage();
    }
}
