<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingComercioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting_comercios')->insert([
            'user_id' => '1',
            'comercio_id' => '1',
            'site_name' => 'BarcoExpres',
            'site_email' => 'barcoexpres@gmail.com',
            'site_title' => 'BarcoExpres',
            'footer_text' => '',
            'sidebar_collapse' => true,
            'in_cellphonecontact' => true,  
            'in_sliderprincipal' => true,
            'in_marcasproductos' => false,
            'currency' => '$',
            'api_bcv' => 'NO',
            'in_impuesto' => 'SI',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

    }
}
