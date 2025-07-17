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

        if (!$this->isIntegerArray($filter->brandIds)) {
            $this->addError('selectedBrands', 'Brands invalids.');
        }

        if (!$this->isIntegerArray($filter->categoryIds)) {
            $this->addError('selectedCategories', 'Categories invalids.');
        }

        if ($this->getErrorBag()->isNotEmpty()) {
            return view('livewire.car-search', [
                'cars' => $cars ?? null,
                'brands' => $brandRepo->getAllCached(),
                'categories' => $categoryRepo->getAllCached(),
                'hasResults' => false,
            ]);
        }

        $cars = $searchUseCase->execute($filter);

        return view('livewire.car-search', [
            'cars' => $cars ?? null,
            'brands' => $brandRepo->getAllCached(),
            'categories' => $categoryRepo->getAllCached(),
            'hasResults' => $cars->isNotEmpty(),
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

    private function isIntegerArray(?array $array): bool
    {
        if (!is_array($array)) {
            return false;
        }

        foreach ($array as $item) {
            if (!filter_var($item, FILTER_VALIDATE_INT)) {
                return false;
            }
        }

        return true;
    }
}
