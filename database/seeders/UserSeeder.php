<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombre' =>'Lorem',
            'apellido' =>'Ipsum',
            'rol' =>'publico',
            'identificacion' =>'122322',
            'contacto' =>'3212312321',
            'email' =>'test@test.com',
            'password' => Hash::make('miguel12345'),
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
            
        DB::table('users')->insert([
            'nombre' =>'Ricardo',
            'apellido' =>'Hernandez',
            'rol' =>'administrador',
            'identificacion' =>'122322',
            'contacto' =>'3212312321',
            'email' =>'Ricardo@test.com',
            'password' => Hash::make('administrador12345'),
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('users')->insert([
            'nombre' =>'Julio',
            'apellido' =>'Lesas',
            'rol' =>'administrador',
            'identificacion' =>'3453212',
            'contacto' =>'2123221',
            'email' =>'hernandez@test.com',
            'password' => Hash::make('administrador12345'),
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('users')->insert([
            'nombre' =>'Alejandro',
            'apellido' =>'Perez',
            'rol' =>'administrador',
            'identificacion' =>'12212243',
            'contacto' =>'654321',
            'email' =>'Perez@test.com',
            'password' => Hash::make('administrador12345'),
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
        DB::table('users')->insert([
            'nombre' =>'Rodolfo',
            'apellido' =>'gutierrez',
            'rol' =>'administrador',
            'identificacion' =>'223212',
            'contacto' =>'12421246',
            'email' =>'gutierrez@test.com',
            'password' => Hash::make('administrador12345'),
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]);
    }
}
