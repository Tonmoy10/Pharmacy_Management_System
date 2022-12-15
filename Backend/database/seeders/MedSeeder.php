<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // for ($i=1; $i<10; $i++)
        // {
        //     DB::table('medicine')->insert([
        //         'med_name' => 'Omidon'.$i,
        //         'price_perunit' =>rand(5,10),
        //         'manufacturingDate'=>date("Y/m/d"),
        //         'expiryDate'=>date("Y/m/d"),
        //         'vendor_id'=>$i,
        //         'vendor_name'=>'Khondu'.$i,
        //         'contract_id'=>rand(0,5),
        //         'Stock'=>rand(10,50)
        //     ]);
        // }

        for ($i=50; $i<65; $i++)
        {
            DB::table('medicine')->insert([
                'med_id'=>$i,
                'med_name' => 'Napa'.$i,
                'price_perunit' =>rand(5,10),
                'manufacturingDate'=>date("Y/m/d"),
                'expiryDate'=>date("Y/m/d"),
                'vendor_id'=>$i,
                'vendor_name'=>'Khondu'.$i,
                'contract_id'=>rand(0,5),
                'Stock'=>rand(10,50)
            ]);
        }

        // for ($i=21; $i<31; $i++)
        // {
        //     DB::table('medicine')->insert([
        //         'med_name' => 'Paracetemol'.$i,
        //         'price_perunit' =>rand(5,10),
        //         'manufacturingDate'=>date("Y/m/d"),
        //         'expiryDate'=>date("Y/m/d"),
        //         'vendor_id'=>$i,
        //         'vendor_name'=>'Khondu'.$i,
        //         'contract_id'=>rand(0,5),
        //         'Stock'=>rand(10,50)
        //     ]);
        // }
    }
}
