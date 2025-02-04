<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromocionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promocions')->insert([   
            'embarcacion_id' => 1,
            'comercio_id' => 1,
            'title' => 'banner3',
            'avatar' => 'dream_banner.jpg',
            'order' => 1,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        
        
    }
}
