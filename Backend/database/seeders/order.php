<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class order extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<30 ; $i++)
        {
            DB::table('orders')->insert([
                'cart_id' =>$i,
                'customer_id'=>rand(0,15),
                'totalbill'=>rand(100,300),
            ]);
        }
    }
}
