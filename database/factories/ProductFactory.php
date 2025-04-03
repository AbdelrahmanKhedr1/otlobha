<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Company;
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
            'title' => $this->faker->word, // توليد اسم منتج عشوائي
            'image' => $this->faker->imageUrl(400, 400, 'products', true), // توليد رابط صورة عشوائي
            'company_id' => Company::inRandomOrder()->value('id'), // اختيار شركة عشوائية
            'category_id' => Category::inRandomOrder()->value('id'), // اختيار فئة عشوائية
            'description' => $this->faker->paragraph, // وصف عشوائي
        ];
    }
}
