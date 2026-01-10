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
        $products = [
            [
                'id' => 1,
                'name' => 'Chocolate Cake',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedii do eiusmod teme.',
                'image' => 'menu-item-01.jpg',
                'price' => '220',
                'category' => 'regular',
                'session' => 0,
                'available' => 'Stock',
            ],
            [
                'id' => 2,
                'name' => 'Klassy Pancake',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedii do eiusmod teme.',
                'image' => 'menu-item-02.jpg',
                'price' => '450',
                'category' => 'regular',
                'session' => 0,
                'available' => 'Stock',
            ],
            [
                'id' => 3,
                'name' => 'Blueberry Cake',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedii do eiusmod teme.',
                'image' => 'menu-item-04.jpg',
                'price' => '650',
                'category' => 'regular',
                'session' => 0,
                'available' => 'Out Of Stock',
            ],
            [
                'id' => 4,
                'name' => 'Klassy Cup Cake',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedii do eiusmod teme.',
                'image' => '733624453.jpg',
                'price' => '80',
                'category' => 'regular',
                'session' => 0,
                'available' => 'Stock',
            ],
            [
                'id' => 5,
                'name' => 'Fresh Chicken Salad',
                'description' => 'Lorem ipsum dolor sit amet, consectetur koit adipiscing elit, sed do.',
                'image' => 'tab-item-01.png',
                'price' => '320',
                'category' => 'special',
                'session' => 0,
                'available' => 'Out Of Stock',
            ],
            [
                'id' => 6,
                'name' => 'Eggs Omelette',
                'description' => 'Lorem ipsum dolor sit amet, consectetur koit adipiscing elit, sed do.',
                'image' => 'tab-item-04.png',
                'price' => '25',
                'category' => 'special',
                'session' => 0,
                'available' => 'Out Of Stock',
            ],
            [
                'id' => 7,
                'name' => 'Orange Juice',
                'description' => 'Lorem ipsum dolor sit amet, consectetur koit adipiscing elit, sed do.',
                'image' => 'tab-item-02.png',
                'price' => '90',
                'category' => 'special',
                'session' => 1,
                'available' => 'Out Of Stock',
            ],
            [
                'id' => 8,
                'name' => 'Dollma Pire',
                'description' => 'Lorem ipsum dolor sit amet, consectetur koit adipiscing elit, sed do.',
                'image' => 'tab-item-05.png',
                'price' => '190',
                'category' => 'special',
                'session' => 2,
                'available' => 'Out Of Stock',
            ],
            [
                'id' => 11,
                'name' => 'Pastry Cake',
                'description' => 'kub muja',
                'image' => '1825744018.JPG',
                'price' => '120',
                'category' => 'regular',
                'session' => 0,
                'available' => 'Stock',
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert($product);
        }
    }
}
