<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'titulo' =>'Extintores',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('categorias')->insert([
            'titulo' =>'Soportes',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('categorias')->insert([
            'titulo' =>'Botiquines',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('categorias')->insert([
            'titulo' =>'Conos',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('categorias')->insert([
            'titulo' =>'Camillas/inmovilizadores',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('categorias')->insert([
            'titulo' =>'Palas',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('categorias')->insert([
            'titulo' =>'Paletas',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('categorias')->insert([
            'titulo' =>'Chalecos',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('categorias')->insert([
            'titulo' =>'Punto ecologico',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('categorias')->insert([
            'titulo' =>'Señalizaciones reglamentarias',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('categorias')->insert([
            'titulo' =>'Kit de derrame',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);  
        DB::table('categorias')->insert([
            'titulo' =>'Señalizacion reglamentaria 30x15',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        
    }
}
