<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'sku' =>'A0001',
            'id_categoria'=>'1',
            'titulo' =>'camisa leñadora',
            'precio'=>'80000',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('productos')->insert([
            'sku' =>'B0001',
            'id_categoria'=>'2',
            'titulo' =>'Zapatos converse',
            'precio'=>'85000',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('productos')->insert([
            'sku' =>'C0001',
            'id_categoria'=>'3',
            'titulo' =>'Reloj Casio x3000',
            'precio'=>'70000',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('productos')->insert([
            'sku' =>'D0001',
            'id_categoria'=>'4',
            'titulo' =>'Pantalon Casual Gris',
            'precio'=>'65000',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
    }
}
