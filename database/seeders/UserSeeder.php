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
            'nombre' =>'Super',
            'apellido' =>'Admin',
            'rol' =>'SuperAdmin',
            'tipo_identidad' =>'CC',
            'identificacion' =>'122322',
            'contacto' =>'3212312321',
            'email' =>'test@test.com',
            'password' => Hash::make('admin12345'),
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),  
        ]); 
    
   
   
   
    }
}
