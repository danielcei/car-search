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
    Car::all()->each->delete();

    Livewire::test(CarSearch::class)
        ->assertSeeHtml('Nenhum carro encontrado');

});

test('lista carros corretamente', function () {
    $cars = Car::factory()->count(5)->create();

    Livewire::test(CarSearch::class)
        ->assertSeeHtml($cars->first()->name)
        ->assertSeeHtml($cars->last()->name);
});
