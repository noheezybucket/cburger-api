<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            'client_firstname' => Str::random(10),
            'client_lastname' => Str::random(100),
            'client_address' => Str::random(100),
            'client_phonenumber'=>'+221 776667788',
            'status' => 'En cours',
            'payed'=>true,
            'burger_id'=>2
        ]);
    }
}
