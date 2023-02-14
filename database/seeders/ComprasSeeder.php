<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComprasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compras')->insert([
            'id_orden' =>'1',
            'id_producto' =>'1',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('compras')->insert([
            'id_orden' =>'1',
            'id_producto' =>'2',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('compras')->insert([
            'id_orden' =>'2',
            'id_producto' =>'3',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('compras')->insert([
            'id_orden' =>'2',
            'id_producto' =>'4',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('compras')->insert([
            'id_orden' =>'3',
            'id_producto' =>'1',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('compras')->insert([
            'id_orden' =>'4',
            'id_producto' =>'4',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
    }
}
