<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create(config('app.faker_locale', 'ru_RU'));

        // Laptops
        for ($i = 1; $i < 5; $i++) {
            Product::create([
                'name'        => 'Ноутбук '.$i,
                'slug'        => 'laptop-'.$i,
                'details'     => $faker->randomElement(['Core i', 'Ryzen '])
                    .$faker->randomElement(['3', '5', '7', '9']).', '
                    .$faker->randomElement(['2.4', '2.7', '3.4', '4.1', '4.6']).' ГГц, '
                    .$faker->randomElement(['8', '16', '32']).' ГБ, '
                    .$faker->randomElement(['128 ГБ', '256 ГБ', '512 ГБ', '1 ТБ', '2 ТБ',]).' SSD',
                'price'       => $faker->numberBetween(3000000, 10000000),
                'description' => $faker->realText(500),
                'featured'    => $faker->numberBetween(0, 1),
                'image'       => 'products/dummy/laptop-'.$i.'.jpeg',
                'images'      => '["products\/dummy\/laptop-'.$i.'-1.jpeg", "products\/dummy\/laptop-'.$i.'-2.jpeg"]',
            ])->categories()->attach(1);
        }

        // Desktops
        for ($i = 1; $i < 5; $i++) {
            Product::create([
                'name'        => 'Системный Блок '.$i,
                'slug'        => 'desktop-'.$i,
                'details'     => $faker->randomElement(['Core i', 'Ryzen '])
                    .$faker->randomElement(['3', '5', '7', '9']).', '
                    .$faker->randomElement(['8', '16', '32']).' ГБ, '
                    .$faker->randomElement(['128 ГБ', '256 ГБ', '512 ГБ', '1 ТБ', '2 ТБ',]).' SSD, '
                    .$faker->randomElement([
                        'AMD Radeon R7', 'AMD Radeon Vega 11', 'Intel UHD Graphics', 'NVIDIA RTX 3090',
                    ]),
                'price'       => $faker->numberBetween(5000000, 20000000),
                'description' => $faker->realText(500),
                'featured'    => $faker->numberBetween(0, 1),
                'image'       => 'products/dummy/desktop-'.$i.'.jpeg',
                'images'      => '["products\/dummy\/desktop-'.$i.'-1.jpeg", "products\/dummy\/desktop-'.$i.'-2.jpeg"]',
            ])->categories()->attach(2);
        }

        // Mobile Phones
        for ($i = 1; $i < 5; $i++) {
            Product::create([
                'name'        => 'Смартфон '.$i,
                'slug'        => 'mobile-phone-'.$i,
                'details'     => 'Дисплей '.$faker->randomElement(['5.45', '6.5', '6.4', '6.7']).'", '
                    .'процессор '.$faker->randomElement(['MediaTek', 'Qualcomm', 'Exynos']).', '
                    .$faker->randomElement(['8', '12', '15', '20']).' МП, '
                    .$faker->randomElement(['64', '128', '256', '512']).' ГБ',
                'price'       => $faker->numberBetween(1000000, 5000000),
                'description' => $faker->realText(500),
                'featured'    => $faker->numberBetween(0, 1),
                'image'       => 'products/dummy/mobile-phone-'.$i.'.jpeg',
                'images'      => '["products\/dummy\/mobile-phone-'.$i.'-1.jpeg", "products\/dummy\/mobile-phone-'.$i
                    .'-2.jpeg"]',
            ])->categories()->attach(3);
        }

        // Tablets
        for ($i = 1; $i < 5; $i++) {
            Product::create([
                'name'        => 'Планшет '.$i,
                'slug'        => 'tablet-'.$i,
                'details'     => 'Дисплей '.$faker->randomElement(['10.1', '8.7', '8', '11']).'", '
                    .$faker->randomElement(['13', '8', '5', '12']).' МП, '
                    .$faker->randomElement(['64', '128', '256', '512']).' ГБ встроенной памяти',
                'price'       => $faker->numberBetween(2000000, 7000000),
                'description' => $faker->realText(500),
                'featured'    => $faker->numberBetween(0, 1),
                'image'       => 'products/dummy/tablet-'.$i.'.jpeg',
                'images'      => '["products\/dummy\/tablet-'.$i.'-1.jpeg", "products\/dummy\/tablet-'.$i.'-2.jpeg"]',
            ])->categories()->attach(4);
        }

        // TVs
        for ($i = 1; $i < 5; $i++) {
            Product::create([
                'name'        => 'Телевизор '.$i,
                'slug'        => 'tv-'.$i,
                'details'     => 'Диагональ '.$faker->randomElement(['50', '32', '70', '43']).'", '
                    .'Ultra HD '.$faker->randomElement(['4K', '8K']).', '
                    .$faker->numberBetween(1, 3).' USB'.', '
                    .$faker->randomElement(['SMART TV', 'встроенный Wi-Fi', ' встроенный Bluetooth']),
                'price'       => $faker->numberBetween(3000000, 15000000),
                'description' => $faker->realText(500),
                'featured'    => $faker->numberBetween(0, 1),
                'image'       => 'products/dummy/tv-'.$i.'.jpeg',
                'images'      => '["products\/dummy\/tv-'.$i.'-1.jpeg", "products\/dummy\/tv-'.$i.'-2.jpeg"]',
            ])->categories()->attach(5);
        }

        // Accessories
        for ($i = 1; $i < 5; $i++) {
            Product::create([
                'name'        => 'Аксессуар '.$i,
                'slug'        => 'accessory-'.$i,
                'details'     => $faker->sentence,
                'price'       => $faker->numberBetween(100000, 2000000),
                'description' => $faker->realText(500),
                'featured'    => $faker->numberBetween(0, 1),
                'image'       => 'products/dummy/accessory-'.$i.'.jpeg',
                'images'      => '["products\/dummy\/accessory-'.$i.'-1.jpeg", "products\/dummy\/accessory-'.$i
                    .'-2.jpeg"]',
            ])->categories()->attach(6);
        }
    }
}
