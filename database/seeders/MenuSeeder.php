<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('menus')->insert([
            'area_id' => '3',
            'comercio_id' => '1',
            'texto' => 'Recreo',
            'ruta' => 'Recreo',
            'origen' => 'link', // view or categories
            'menu' => 1,
            'posicion' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('menus')->insert([
            'area_id' => '3',
            'comercio_id' => '1',
            'texto' => 'Arrastre',
            'ruta' => 'Arrastre',
            'origen' => 'link', // view or categories
            'menu' => 1,
            'posicion' => 2,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('menus')->insert([
            'area_id' => '3',
            'comercio_id' => '1',
            'texto' => 'Cerco',
            'ruta' => 'Cerco',
            'origen' => 'link', // view or categories
            'menu' => 1,
            'posicion' => 3,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('menus')->insert([
            'area_id' => '3',
            'comercio_id' => '1',
            'texto' => 'Palangre',
            'ruta' => 'Palangre',
            'origen' => 'link', // view or categories
            'menu' => 1,
            'posicion' => 4,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('menus')->insert([
            'area_id' => '3',
            'comercio_id' => '1',
            'texto' => 'Artes menores',
            'ruta' => 'Artes menores',
            'origen' => 'link', // view or categories
            'menu' => 1,
            'posicion' => 5,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('menus')->insert([
            'area_id' => '3',
            'comercio_id' => '1',
            'texto' => 'Motores',
            'ruta' => 'Motores',
            'origen' => 'link', // view or categories
            'menu' => 1,
            'posicion' => 6,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

    }
}
