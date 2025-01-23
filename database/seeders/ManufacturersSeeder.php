<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        DB::table('manufacturers')->insert([
            'name' => 'Marca 1',
            'avatar' => 'logomarca_01.jpg',
            'mercado' => 'original',
            'area_id' => '3',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Marca 2',
            'avatar' => 'logomarca_02.jpg',
            'mercado' => 'original',
            'area_id' => '3',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Marca 3',
            'avatar' => 'logomarca_03.jpg',
            'mercado' => 'original',
            'area_id' => '3',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Marca 4',
            'avatar' => 'logomarca_04.jpg',
            'mercado' => 'original',
            'area_id' => '3',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Marca 5',
            'avatar' => 'logomarca_05.jpg',
            'mercado' => 'original',
            'area_id' => '3',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

    }
}
