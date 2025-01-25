<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ComercioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // id 1
        DB::table('comercios')->insert([
            'area_id' => '3',
            'user_id' => '1',
            'keyword' => 'barcoexpres',
            'name' => 'BarcoExpres',
            'avatar' => 'logo_barcoexpre.jpg',
            'banner' => 'banner_barcoexpres.png',
            'contactcellphone' => '04265173538',
            'contactphone'  => '0212-578-44-68',
            'msgcontact'  => 'Hola, te asesoramos por  whatsapp gestiona tu compra por este canal.',
            'horario'  => 'Lunes a Domingo hora: 6:30 am a 8:00 pm',
            'email'  => 'barcoexpres@gmail.com',
            'youtube'  => '',
            'twitter'  => '',
            'facebook'  => '',
            'instagram'  => '',
            'dominio' => 'http://www.barcoexpres.com',
            'address'  => 'Caracas, Venezuela',
            'rifLetter' => 'J',
            'rifNumber' => '31512955-8',
            // 'dominio' => 'http://www.repuestoexpres.com',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        // id 2
        
    }
}

        
        
        