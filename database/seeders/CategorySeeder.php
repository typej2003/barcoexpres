<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Embarcaciones de pesca',
            'description' => 'Embarcaciones de pesca',
            'img' => '',
            'parent' => '1',
            'category_id' => '0',
            'ruta' => 'Embarcaciones de pesca',
            'user_id' => '1',
            'area_id' => '3',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('categories')->insert([
            'name' => 'Recreo',
            'description' => 'Embarcaciones de pesca -> Recreo',
            'img' => '',
            'parent' => '0',
            'category_id' => '1',
            'ruta' => 'Recreo',
            'user_id' => '1',
            'area_id' => '3',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('categories')->insert([
            'name' => 'Arrastre',
            'description' => 'Arrastre',
            'img' => '',
            'parent' => '0',
            'category_id' => '1',
            'ruta' => 'Embarcaciones de pesca -> Arrastre',
            'user_id' => '1',
            'area_id' => '3',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('categories')->insert([
            'name' => 'Cerco',
            'description' => 'Cerco',
            'img' => '',
            'parent' => '0',
            'category_id' => '1',
            'ruta' => 'Embarcaciones de pesca -> Cerco',
            'user_id' => '1',
            'area_id' => '3',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('categories')->insert([
            'name' => 'Palangre',
            'description' => 'Palangre',
            'img' => '',
            'parent' => '0',
            'category_id' => '1',
            'ruta' => 'Embarcaciones de pesca -> Palangre',
            'user_id' => '1',
            'area_id' => '3',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('categories')->insert([
            'name' => 'Artes menores',
            'description' => 'Artes menores',
            'img' => '',
            'parent' => '0',
            'category_id' => '1',
            'ruta' => 'Embarcaciones de pesca -> Artes menores',
            'user_id' => '1',
            'area_id' => '3',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('categories')->insert([
            'name' => 'Motores',
            'description' => 'Motores',
            'img' => '',
            'parent' => '0',
            'category_id' => '1',
            'ruta' => 'Embarcaciones de pesca -> Motores',
            'user_id' => '1',
            'area_id' => '3',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

    }
}

