<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::factory(50)
            ->create();
    }
}
