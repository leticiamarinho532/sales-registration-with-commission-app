<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('seller')->insert([
                'name' => Str::random(10),
                'email' => fake()->unique()->email(),
                'created_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
        }
    }
}
