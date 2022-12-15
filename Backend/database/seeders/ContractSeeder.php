<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i<15 ; $i++)
        {
            DB::table('contract')->insert([
                'contract_id' => $i+1,
                'vendor_id' => $i,
                'manager_id' => 1,
                //'cart_id' => 1,
                'med_name' => 'Napa'.$i,
                'quantity' => rand(1,100),
                'total_price' => rand(5,1000),
            ]);
        }
    }
}
