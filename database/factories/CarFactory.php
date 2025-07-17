<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use Faker\Provider\FakeCar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @template TModel of \App\Models\Car
 *
 * @extends Factory<TModel>
 */
class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new FakeCar($this->faker));
        $vehicle = $this->faker->vehicleArray();

        $brand = Brand::firstOrCreate(
            ['name' => $vehicle['brand']],
            ['slug' => str()->slug($vehicle['brand'])]
        );

        $category = Category::firstOrCreate(
            ['name' => $this->faker->vehicleType],
            ['slug' => str()->slug($this->faker->vehicleType)]
        );

        return [
            'name' => $this->faker->vehicle,
            'slug' => str()->slug($vehicle['model']),
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'description' => null,
            'price' => $this->faker->randomFloat(2, 10000, 100000),
            'year' => $this->faker->biasedNumberBetween(1990, date('Y')),
            'vin' => $this->faker->vin,
            'fuel_type' => $this->faker->vehicleFuelType,
            'image_url' => 'http://localhost:8181/images/' . random_int(1, 27) . '.jpg',
        ];
    }
}
