<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_ar' => fake()->unique()->word(), // اسم عربي عشوائي
            'name_en' => fake()->unique()->word(), // اسم إنجليزي عشوائي
            'category_id' => Category::inRandomOrder()->first()?->id, // اختيار تصنيف عشوائي
        ];
    }
}
