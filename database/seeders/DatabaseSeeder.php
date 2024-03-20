<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('usuarios.users')->insert([
            'run' => '11111111',
            'dv' => '1',
            'nombres' => 'usuario',
            'apellido_paterno' => '1',
            'email' => 'usuario1@mail.com',
            'password' => Hash::make('prueba123')
        ]);

        DB::table('usuarios.users')->insert([
            'run' => '22222222',
            'dv' => '2',
            'nombres' => 'usuario',
            'apellido_paterno' => '2',
            'email' => 'usuario2@mail.com',
            'password' => Hash::make('prueba123')
        ]);

        DB::table('prueba.ficha')->insert([
            'id' => 1,
            'nombre' => 'Ficha 1',
            'url' => 'URL',
        ]);

        DB::table('prueba.ficha')->insert([
            'id' => 2,
            'nombre' => 'Ficha 2',
            'url' => 'URL',
        ]);

        DB::table('prueba.beneficios')->insert([
            'id' => 1,
            'nombre' => 'Beneficio 1',
            'id_ficha' => 1
        ]);

        DB::table('prueba.beneficios')->insert([
            'id' => 2,
            'nombre' => 'Beneficio 2',
            'id_ficha' => 2
        ]);

        DB::table('prueba.montos_maximos')->insert([
            'id_beneficio' => 1,
            'monto_minimo' => 0,
            'monto_maximo' => 300000,
        ]);

        DB::table('prueba.montos_maximos')->insert([
            'id_beneficio' => 2,
            'monto_minimo' => 0,
            'monto_maximo' => 100000,
        ]);

        DB::table('prueba.beneficios_entregados')->insert([
            'id_beneficio' => 1,
            'run' => '11111111',
            'dv' => '1',
            'total' => 300000,
            'estado' => 'vigente'
        ]);

        DB::table('prueba.beneficios_entregados')->insert([
            'id_beneficio' => 2,
            'run' => '22222222',
            'dv' => '2',
            'total' => 100000,
            'estado' => 'vigente'
        ]);
    }
}
