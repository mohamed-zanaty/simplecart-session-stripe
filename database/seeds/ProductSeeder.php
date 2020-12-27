<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'title' => 'clothes',
            'price' => 4000,
            'image' => 'default.png',
        ]);

        DB::table('products')->insert([
            'title' => 'watches',
            'price' => 3000,
            'image' => 'default.png',
        ]);

        DB::table('products')->insert([
            'title' => 'cars',
            'price' => 2000,
            'image' => 'default.png',
        ]);
    }
}
