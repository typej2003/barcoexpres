<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValoracionBoatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('valoracion_boats')->insert([
            'user_id' => '1',
            'embarcacion_id' => '1',
            'ca_valoracion' => '5',
            'class'  => 'five',
            'comment'  => 'Excelente Producto',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
    }
}
