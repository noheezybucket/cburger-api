<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BurgerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('burgers')->insert([
            'name' => 'Double Steak Burger',
            'description' => Str::random(100),
            'price' => 2500,
            'image' => 'default.png' 
        ]);
    }
}
