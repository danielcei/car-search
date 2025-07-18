<div class="container mx-auto px-6 py-10">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Filtros (Sidebar) -->
        <div class="lg:w-1/4 w-full bg-gray-900 rounded-lg shadow-lg p-6 text-gray-200">
            <div class="flex flex-col gap-6">
                <!-- Search Input -->
                <div>
                    <label for="search" class="block text-sm font-semibold mb-2">Nome do Carro</label>
                    <input
                        type="text"
                        id="search"
                        wire:model.live.debounce.500ms="search"
                        placeholder="Pesquisar carros..."
                        class="w-full rounded-md bg-gray-800 border border-blue-500 focus:border-blue-400 focus:ring-2 focus:ring-blue-500 focus:outline-none px-4 py-2 text-gray-100"
                    />
                </div>

                <!-- Marcas -->
                <div class="bg-gray-800 p-4 rounded-lg">
                    <label class="block text-sm font-semibold text-gray-300 mb-3">Marcas</label>
                    <div class="space-y-2 max-h-60 overflow-y-auto p-1">
                        @foreach($brands as $brand)
                            <label
                                class="flex items-center space-x-3 cursor-pointer hover:bg-gray-700 rounded px-2 py-1">
                                <input
                                    type="checkbox"
                                    wire:model.live="selectedBrands"
                                    value="{{ $brand->id }}"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600"
                                >
                                <span class="text-gray-300">{{ $brand->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Categorias -->
                <div class="bg-gray-800 p-4 rounded-lg">
                    <label class="block text-sm font-semibold text-gray-300 mb-3">Categorias</label>
                    <div class="space-y-2 max-h-60 overflow-y-auto p-1">
                        @foreach($categories as $category)
                            <label
                                class="flex items-center space-x-3 cursor-pointer hover:bg-gray-700 rounded px-2 py-1">
                                <input
                                    type="checkbox"
                                    wire:model.live="selectedCategories"
                                    value="{{ $category->id }}"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600"
                                >
                                <span class="text-gray-300">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Botão Limpar -->
                <div class="flex justify-end">
                    <button
                        wire:click="resetFilters"
                        class="bg-blue-600 hover:bg-blue-700 transition-colors rounded-md px-6 py-2 font-semibold text-white shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                        title="Limpar filtros"
                    >
                        Limpar Filtros
                    </button>
                </div>
            </div>
        </div>

        @if ($hasResults)
            <div class="lg:w-3/4 w-full">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($cars as $car)
                        <div
                            class="bg-gray-900 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                            <img
                                src="{{ $car->image_url ?? 'https://via.placeholder.com/400x200?text=Carro' }}"
                                alt="{{ $car->name }}"
                                class="w-full h-48 object-cover"
                            />
                            <div class="p-5">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="text-xl font-bold text-white">{{ $car->name }}</h3>
                                    <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $car->brand->name }}
                                </span>
                                </div>
                                <p class="text-gray-300 text-sm mb-4">{{ Str::limit($car->description, 120) }}</p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-blue-700 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $car->category->name }}
                                </span>
                                </div>
                                <div class="text-right">
                                <span class="text-2xl font-extrabold text-blue-400">
                                    R$ {{ number_format($car->price, 2, ',', '.') }}
                                </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="mt-10 flex justify-center">
                    {{ $cars->links() }}
                </div>
            </div>
        @else
            <div class="w-full">
                <div class="flex items-center justify-center min-h-screen bg-gray-100">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">Nenhum carro encontrado</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @if($search || $selectedBrands || $selectedCategories)
                                Tente ajustar seus critérios de busca.
                            @else
                                Não encontramos nenhum carro disponível no momento.
                            @endif
                        </p>

                        @if ($errors->has('filters-erros'))
                            <div class="mt-2 text-red-600 text-sm">{{ $errors->first('filters-erros') }}</div>
                        @endif

                        @if($search || $selectedBrands || $selectedCategories)
                            <div class="mt-6">
                                <button wire:click="resetFilters" type="button"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Limpar filtros
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

