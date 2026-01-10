<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('products')->insert([    
                'name' => $faker->word(),  
                'description' => $faker->sentence(),  
                'image' => $faker->randomElement(['menu-item-01.jpg', 'menu-item-02.jpg', 'menu-item-03.jpg', 'tab-item-01.png', 'tab-item-02.png']),  
                'price' => $faker->randomFloat(2, 10, 100),
                'category' => $faker->randomElement(['regular', 'special']),
                'session' => $faker->numberBetween(0, 2),
                'available' => 'Stock',
             ]);  
        }

    }
}
