<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('sale')->insert([
                'value' => rand(50, 1000),
                'seller_id' => rand(1, 5),
                'created_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
        }
    }
}
