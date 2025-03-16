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
            'title' => 'banner1',
            'avatar' => 'banner_barco1.jpg',
            'order' => 1,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'embarcacion_id' => 1,
            'comercio_id' => 1,
            'title' => 'banner2',
            'avatar' => 'banner_barco2.jpg',
            'order' => 2,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        
        DB::table('promocions')->insert([   
            'embarcacion_id' => 1,
            'comercio_id' => 1,
            'title' => 'banner3',
            'avatar' => 'banner_dream.jpg',
            'order' => 3,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'embarcacion_id' => 1,
            'comercio_id' => 1,
            'title' => 'banner5',
            'avatar' => 'banner_loreanna.jpg',
            'order' => 5,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'embarcacion_id' => 1,
            'comercio_id' => 1,
            'title' => 'banner4',
            'avatar' => 'banner_lorella.jpg',
            'order' => 4,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'embarcacion_id' => 1,
            'comercio_id' => 1,
            'title' => 'banner6',
            'avatar' => 'banner_oceano.jpg',
            'order' => 6,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        
    }
}
