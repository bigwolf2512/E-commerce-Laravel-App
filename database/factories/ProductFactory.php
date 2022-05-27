<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph(1),
            'quantity_available' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(10, 20),
            'status' => $this->faker->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
            'image' => $this->faker->randomElement([
                'https://image.shutterstock.com/image-photo/chicken-fillet-salad-healthy-food-600w-1721943142.jpg',
                'https://image.shutterstock.com/image-photo/mixed-salad-spinach-rocket-grilled-600w-1833269269.jpg',
                'https://image.shutterstock.com/image-photo/fried-fish-poured-ketchup-not-600w-89277940.jpg',
                'https://image.shutterstock.com/image-photo/grilled-salmon-vegetables-eggs-sour-600w-130371821.jpg'
            ]),
            'seller_id' => User::all()->random()->id, //or just like this: User::inRandomOrder()->first()->id,
        ];
    }
}
