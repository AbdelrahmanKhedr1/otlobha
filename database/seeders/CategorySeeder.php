<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::insert([
            ['name' => "مطعم", 'image' => '1.jpeg'],
            ['name' => "صيدليه", 'image' => '2.jpeg'],
            ['name' => "متجر", 'image' => '3.jpeg'],
        ]);

    }
}
