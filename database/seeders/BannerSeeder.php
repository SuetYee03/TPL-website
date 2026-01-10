<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            ['id' => 1, 'image' => 'slide-01.jpg'],
            ['id' => 2, 'image' => 'slide-02.jpg'],
            ['id' => 3, 'image' => 'slide-03.jpg'],
        ]);
    }
}
