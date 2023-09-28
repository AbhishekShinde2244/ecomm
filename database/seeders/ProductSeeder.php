<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        //
        DB::table('products')->insert([
            'name' => 'Lg Mobile',
            'gallery' =>
                'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcRIkPhuDL8LwvSqLVxb4KrMoVss51PKNB8x8-Jkr2QQBvRe0SWXZc_gPm3-eN1YlpqbEkHUq_Gm0bqkjkDqkdKZzDElCJ_bXwZFt2-665vI',
            'price' => 10000,
            'description' => 'smartphone with 4gb ram and much more features',
            'category' => 'mobile',
        ]);
    }
}
