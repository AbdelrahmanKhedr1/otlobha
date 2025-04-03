<?php

namespace Database\Seeders;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::insert([
            ['city' => "محافظة أسوان", 'status' => '0'],
            ['city' => "محافظة أسيوط", 'status' => '0'],
            ['city' => "محافظة الإسكندرية", 'status' => '0'],
            ['city' => "محافظة الإسماعيلية", 'status' => '0'],
            ['city' => "محافظة البحر الأحمر", 'status' => '0'],
            ['city' => "محافظة البحيرة", 'status' => '0'],
            ['city' => "محافظة بني سويف", 'status' => '0'],
            ['city' => "محافظة الجيزة", 'status' => '0'],
            ['city' => "محافظة الدقهلية", 'status' => '0'],
            ['city' => "محافظة السويس", 'status' => '0'],
            ['city' => "محافظة الشرقية", 'status' => '0'],
            ['city' => "محافظة الغربية", 'status' => '0'],
            ['city' => "محافظة الفيوم", 'status' => '0'],
            ['city' => "محافظة القاهرة", 'status' => '0'],
            ['city' => "محافظة القليوبية", 'status' => '0'],
            ['city' => "محافظة المنوفية", 'status' => '0'],
            ['city' => "محافظة المنيا", 'status' => '0'],
            ['city' => "محافظة الوادي الجديد", 'status' => '0'],
            ['city' => "محافظة بورسعيد", 'status' => '0'],
            ['city' => "محافظة جنوب سيناء", 'status' => '0'],
            ['city' => "محافظة دمياط", 'status' => '0'],
            ['city' => "محافظة سوهاج", 'status' => '0'],
            ['city' => "محافظة شمال سيناء", 'status' => '0'],
            ['city' => "محافظة قنا", 'status' => '0'],
            ['city' => "محافظة كفر الشيخ", 'status' => '0'],
            ['city' => "محافظة مطروح", 'status' => '0'],
            ['city' => "محافظة الأقصر", 'status' => '0'],
        ]);

    }
}
