<?php

use App\Livewire\CarSearch;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use Livewire\Livewire;

test('filtro de pesquisa', function () {
    Car::all()->each->delete();
    $fusca = Car::factory()->create(['name' => 'Fusca']);
    $gol = Car::factory()->create(['name' => 'Gol']);

    Livewire::test(CarSearch::class)
        ->set('search', 'Fusca')
        ->assertSeeHtml($fusca->name)
        ->assertDontSeeHtml($gol->name);
});

test('filtro de pesquisa nao encontrado', function () {
    Car::all()->each->delete();
    Car::factory()->create(['name' => 'Fusca']);
    Car::factory()->create(['name' => 'Gol']);
    Livewire::test(CarSearch::class)
        ->set('search', 'xxxxx')
        ->assertSeeHtml('Nenhum carro encontrado');
});

test('filtro por marca', function () {
    list($volkswagen, $gol, $uno, $fiat) = criarCarroComMarca();
    Livewire::test(CarSearch::class)
        ->set('selectedBrands.0', $volkswagen->id)
        ->assertSeeHtml($gol->name)
        ->assertDontSeeHtml($uno->name);
});

test('filtro por duas marca', function () {
    list($volkswagen, $gol, $uno, $fiat) = criarCarroComMarca();

    Livewire::test(CarSearch::class)
        ->set('selectedBrands.0', $volkswagen->id)
        ->set('selectedBrands.1', $fiat->id)
        ->assertSeeHtml($gol->name)
        ->assertSeeHtml($uno->name);
});

test('filtro marca injection', function () {
    list($volkswagen, $gol, $uno, $fiat) = criarCarroComMarca();
    Livewire::test(CarSearch::class)
        ->set('selectedBrands.0', '0=teste')
        ->assertSeeHtml('Brands invalids.');
});

test('filtro por categoria', function () {
    list($volkswagen, $gol, $uno, $fiat) = criarCarroComCategoria();
    Livewire::test(CarSearch::class)
        ->set('selectedCategories.0', $volkswagen->id)
        ->assertSeeHtml($gol->name)
        ->assertDontSeeHtml($uno->name);
});

test('filtro por duas categoria', function () {
    list($volkswagen, $gol, $uno, $fiat) = criarCarroComCategoria();
    Livewire::test(CarSearch::class)
        ->set('selectedCategories.0', $volkswagen->id)
        ->set('selectedCategories.1', $fiat->id)
        ->assertSeeHtml($gol->name)
        ->assertSeeHtml($uno->name);
});

test('filtro categoria injection', function () {
    list($volkswagen, $gol, $uno, $fiat) = criarCarroComMarca();
    Livewire::test(CarSearch::class)
        ->set('selectedCategories.0', '0=teste')
        ->assertSeeHtml('Categories invalids.');
});

function criarCarroComMarca(): array
{
    Car::all()->each->delete();
    $volkswagen = Brand::create(['name' => 'Volkswagen', 'slug' => 'volkswagen']);
    $fiat = Brand::create(['name' => 'Fiat', 'slug' => 'fiat']);
    $gol = Car::factory()->create(['name' => 'Gol_7898', 'brand_id' => $volkswagen->id]);
    $uno = Car::factory()->create(['name' => 'Uno_2456', 'brand_id' => $fiat->id]);
    return array($volkswagen, $gol, $uno, $fiat);
}

function criarCarroComCategoria(): array
{
    Car::all()->each->delete();
    $volkswagen = Category::create(['name' => 'SUV', 'slug' => 'suv']);
    $fiat = Category::create(['name' => 'Jipe', 'slug' => 'jipe']);
    $gol = Car::factory()->create(['name' => 'Gol_7898', 'category_id' => $volkswagen->id]);
    $uno = Car::factory()->create(['name' => 'Uno_2456', 'category_id' => $fiat->id]);
    return array($volkswagen, $gol, $uno, $fiat);
}
