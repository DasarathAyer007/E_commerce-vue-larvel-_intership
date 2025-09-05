<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->word(),
            'description'=>$this->faker->sentence(),
            // 'image_path'=>$this->faker->word(10),
            'image_path'=>'products/product.jpg',

            'quantity'=>$this->faker->randomNumber(2),
            'price'=>$this->faker->randomNumber(3),
            'category_id'=>$this->faker->numberBetween(1,3),
            'user_id'=>$this->faker->numberBetween(1,2)
        ];
    }
}
