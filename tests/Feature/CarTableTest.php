<?php

use Illuminate\Support\Facades\Schema;
use Tests\DatabaseTestCase;

test('tabela cars existe com colunas corretas', function () {
    $this->assertTrue(Schema::hasTable('cars'));
    $columns = Schema::getColumnListing('cars');
    $expectedColumns = [
        'name',
        'slug',
        'brand_id',
        'category_id',
        'description',
        'price'
    ];

    foreach ($expectedColumns as $column) {
        $this->assertContains($column, $columns);
    }
});

test('colunas da tabela cars têm tipos corretos', function () {
    $this->assertEquals('varchar', Schema::getColumnType('cars', 'name'));
    $this->assertEquals('int8', Schema::getColumnType('cars', 'brand_id'));
    $this->assertEquals('int8', Schema::getColumnType('cars', 'category_id'));
    $this->assertEquals('varchar', Schema::getColumnType('cars', 'year'));
    $this->assertEquals('text', Schema::getColumnType('cars', 'description'));
    $this->assertEquals('numeric', Schema::getColumnType('cars', 'price'));
});

test('tabela category existe com colunas corretas', function () {
    $this->assertTrue(Schema::hasTable('categories'));
    $columns = Schema::getColumnListing('categories');
    $expectedColumns = [
        'name',
        'slug',
    ];

    foreach ($expectedColumns as $column) {
        $this->assertContains($column, $columns);
    }
});

test('colunas da tabela category têm tipos corretos', function () {
    $this->assertEquals('varchar', Schema::getColumnType('categories', 'name'));
    $this->assertEquals('varchar', Schema::getColumnType('categories', 'slug'));
});


test('tabela brands existe com colunas corretas', function () {
    $this->assertTrue(Schema::hasTable('brands'));
    $columns = Schema::getColumnListing('brands');
    $expectedColumns = [
        'name',
        'slug',
    ];

    foreach ($expectedColumns as $column) {
        $this->assertContains($column, $columns);
    }
});

test('colunas da brands category têm tipos corretos', function () {
    $this->assertEquals('varchar', Schema::getColumnType('brands', 'name'));
    $this->assertEquals('varchar', Schema::getColumnType('brands', 'slug'));
});
