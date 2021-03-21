<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'quantity' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->numberBetween(1, 1000),
            'photo' => 'images/products/' . $this->faker->image('public/storage/images/products', 400, 300, null, false),
            'created_by' => 1
        ];
    }
}
