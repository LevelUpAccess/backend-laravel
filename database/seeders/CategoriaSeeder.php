<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categorias')->insert([
            'nombre' => 'Más vendidos',
            'icono' => 'mas_vendidos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Más jugados',
            'icono' => 'mas_jugados',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        DB::table('categorias')->insert([
            'nombre' => 'Destacados',
            'icono' => 'destacados',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        DB::table('categorias')->insert([
            'nombre' => 'Nuevos lanzamientos',
            'icono' => 'nuevos_lanzamientos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        DB::table('categorias')->insert([
            'nombre' => 'Juegos gratuitos',
            'icono' => 'juegos_gratuitos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        
        DB::table('categorias')->insert([
            'nombre' => 'Más populares',
            'icono' => 'mas_populares',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
       

    }
}
