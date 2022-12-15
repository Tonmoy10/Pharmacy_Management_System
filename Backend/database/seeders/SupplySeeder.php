<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SupplySeeder extends Seeder
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
            DB::table('supply')->insert([
                'med_id' => $i+1,
                'med_name' => 'Napa'.$i,
                'price_perunit' =>rand(5,10),
                'stock' => rand(10,50),
                'manufacturingDate'=>date("Y/m/d"),
                'expiryDate'=>date("Y/m/d"),
                'vendor_id'=>1
                //'contract_id'=>rand(0,5)
            ]);
        }
    }
}
