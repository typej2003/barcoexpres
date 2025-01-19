<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmbarcacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('embarcacions')->insert([
            'code' => 'E0001',
            'name' => 'Barco 1',
            'additional_information' => 'Pan de Jamón de 650 gramos',
            'details1' => 'Ofertas Pan de Jamón de 650 gramos',
            'image_path1' => 'pan_expreso.jpg',
            'manufacturer_id' => '1', //marca
            'currency' => '$', //moneda
            'price1' => 8.0, //precio al detal
            'price_offer' => 1, //precio de oferta
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'stock_min' => 1,
            'stock_max' => 1,
            'stock' => 50, // cant en almacen
            'area_id' => 3,
            'user_id' => 1,
            'comercio_id' => 1,
            'category_id' => 1,
            'subcategory_id' => 1,
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
    }
}
