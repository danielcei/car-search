<?php

use App\Livewire\CarSearch;
use App\Models\Car;
use function Pest\Laravel\get;
use Livewire\Livewire;

test('página de listagem de carros carrega corretamente', function () {
    $response = get('/');
    $response->assertStatus(200);
});

test('componente Livewire carrega corretamente', function () {
    Livewire::test(CarSearch::class)
        ->assertOk();
});

test('mostra mensagem quando não há carros cadastrados', function () {
    Car::query()->delete();
    Livewire::test(CarSearch::class)
        ->assertSeeHtml('<h3 class="mt-2 text-lg font-medium text-gray-900">Nenhum carro encontrado</h3>');
});

test('lista carros corretamente', function () {
    $cars = Car::factory()->count(5)->create();

    Livewire::test(CarSearch::class)
        ->assertSeeHtml($cars->first()->name)
        ->assertSeeHtml($cars->last()->name);
});
