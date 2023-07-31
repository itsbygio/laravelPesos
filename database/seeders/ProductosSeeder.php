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
            'sku' =>'E0001',
            'id_categoria'=>'1',
            'titulo' =>'Extintor tipo k 1.5 gls',
            'stock' =>'20',
            'precio'=>'255000',
            'size_image' =>'extintor.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('productos')->insert([
            'sku' =>'S0001',
            'id_categoria'=>'2',
            'titulo' =>'Soporte tipo canastilla cromado 10 lbs',
            'stock' =>'40',
            'precio'=>'35000',
            'size_image' =>'soporte.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
        DB::table('productos')->insert([
            'sku' =>'B0001',
            'id_categoria'=>'3',
            'titulo' =>'Botiquin 18 productos reglamentario',
            'stock' =>'30',
            'precio'=>'40000',
            'size_image' =>'botiquin.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('productos')->insert([
            'sku' =>'C0001',
            'id_categoria'=>'4',
            'titulo' =>'Cono PVC x45 cm',
            'stock' =>'45',
            'precio'=>'120000',
            'size_image' =>'cono.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        
        DB::table('productos')->insert([
            'sku' =>'CA0001',
            'id_categoria'=>'5',
            'titulo' =>'Camilla',
            'stock' =>'10',
            'precio'=>'250000',
            'size_image' =>'camilla.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('productos')->insert([
            'sku' =>'CA0001',
            'id_categoria'=>'5',
            'titulo' =>'Inmovilizador cervical multitalla',
            'stock' =>'30',
            'precio'=>'90000',
            'size_image' =>'inmovilizador.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('productos')->insert([
            'sku' =>'P0001',
            'id_categoria'=>'6',
            'titulo' =>'Pala antichispa ',
            'stock' =>'35',
            'precio'=>'110000',
            'size_image' =>'pala.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('productos')->insert([
            'sku' =>'CH0001',
            'id_categoria'=>'7',
            'titulo' =>'Chaleco salvavida ',
            'stock' =>'50',
            'precio'=>'80000',
            'size_image' =>'chaleco.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('productos')->insert([
            'sku' =>'PA0001',
            'id_categoria'=>'8',
            'titulo' =>'Paleta pare/siga',
            'stock' =>'60',
            'precio'=>'40000',
            'size_image' =>'paleta.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('productos')->insert([
            'sku' =>'PU0001',
            'id_categoria'=>'9',
            'titulo' =>'Punto ecologico x 55 gls ',
            'stock' =>'10',
            'precio'=>'450000',
            'size_image' =>'punto.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('productos')->insert([
            'sku' =>'SR0001',
            'id_categoria'=>'10',
            'titulo' =>'Señalizacion peligro carga larga y ancha grande',
            'stock' =>'65',
            'precio'=>'50000',
            'size_image' =>'carga larga.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('productos')->insert([
            'sku' =>'SR0001',
            'id_categoria'=>'11',
            'titulo' =>'Kit de derrame 10 gls',
            'stock' =>'20',
            'precio'=>'230000',
            'size_image' =>'kit derrame.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('productos')->insert([
            'sku' =>'SR0001',
            'id_categoria'=>'12',
            'titulo' =>'Prohibido parquear',
            'stock' =>'70',
            'precio'=>'65000',
            'size_image' =>'Prohibido parquear.jpg',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);

    }
}
