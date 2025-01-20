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
            'embarcacion_id' => 0,
            'comercio_id' => 1,
            'title' => 'banner1',
            'avatar' => 'barcoexpres_banner_princ_01.jpg',
            'order' => 1,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'embarcacion_id' => 0,
            'comercio_id' => 1,
            'title' => 'banner2',
            'avatar' => 'barcoexpres_banner_princ_02.jpg',
            'order' => 1,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'embarcacion_id' => 0,
            'comercio_id' => 1,
            'title' => 'banner3',
            'avatar' => 'barcoexpres_banner_princ_03.jpg',
            'order' => 1,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'embarcacion_id' => 0,
            'comercio_id' => 1,
            'title' => 'banner4',
            'avatar' => 'barcoexpres_banner_princ_04.jpg',
            'order' => 1,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'embarcacion_id' => 0,
            'comercio_id' => 1,
            'title' => 'banner5',
            'avatar' => 'barcoexpres_banner_princ_05.jpg',
            'order' => 1,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'embarcacion_id' => 0,
            'comercio_id' => 1,
            'title' => 'banner6',
            'avatar' => 'barcoexpres_banner_princ_06.jpg',
            'order' => 1,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        
    }
}
