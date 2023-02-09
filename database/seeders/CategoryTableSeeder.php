<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        Category::insert(array_map(fn($category) => [...$category, 'created_at' => $now, 'updated_at' => $now], [
            ['name' => 'Ноутбуки', 'slug' => 'laptops'],
            ['name' => 'Системные блоки', 'slug' => 'desktops'],
            ['name' => 'Смартфоны', 'slug' => 'mobile-phones'],
            ['name' => 'Планшеты', 'slug' => 'tablets'],
            ['name' => 'Телевизоры', 'slug' => 'tvs'],
            ['name' => 'Аксессуары', 'slug' => 'accessories'],
        ]));
    }
}
