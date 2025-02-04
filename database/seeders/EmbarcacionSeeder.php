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
            'area_id' => '3',
            'user_id' => '1',
            'comercio_id' => '1',
            'category_id' => '1',
            'subcategory_id' => '1',
            'subcategories' => '1',
            'code' => 'B0001',
            'name' => 'Dream Cometrue',
            'image_path1' => 'dream_foto1.jpeg',
            'image_path2' => 'dream_foto2.jpg',
            'image_path3' => 'dream_foto3.jpg',
            'image_path4' => '',
            'video_path1' => '',
            'manufacturer_id' => '1',
            'details1' => '',
            'condition' => '',
            'eslora' => '25,95 MTS',
            'manga' => '7,62 MTS',
            'fe_fabricacion' => '1996',
            'color' => '',
            'material' => '',
            'maximumcrew' => '',
            'nroengines' => '',
            'anno_motor' => '',
            'enginebrand' => '',
            'enginemodel' => '',
            'enginetype' => '',
            'hoursofuse' => '',
            'power' => '1300 HP',
            'estereo' => '',
            'negotiable' => '',
            'additional_information' => '',
            'currency' => '',
            'price1' => '900',
            'price2' => '1',
            'price_offer' => '1',
            'price_divisa' => '1',
            'stock_min' => '1',
            'stock_max' => '1',
            'stock' => '1',
            'in_pickup' => '0',
            'in_delivery' => '0',
            'in_envio_nacional' => '0',
            'madein' => '',
            'in_pedido' => '0',
            'in_offer' => '0',
            'ca_valoracion' => '5',
            'in_valido' => '1',
            'matricula' => 'ARSI-PE-0062',
            'distintivollamada' => 'YYP-5.817',
            'nroomi' => '8940141',
            'nrommsi' => '775993501',
            'armador' => 'LOREANNA PESCA C.A.',
            'puntal' => '3,81 MTS',
            'arqueobruto' => '147,91 MTS',
            'arqueoneto' => '66,56 MTS',
            'capacidadcombustible' => '120.360 LTS',
            'capacidadalmacenamiento' => '30 TON',
            'puertoregistro' => 'GUIRIA',
            'artepesca' => 'PALANGRE ATUNERO',
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('embarcacions')->insert([
            'area_id' => '3',
            'user_id' => '1',
            'comercio_id' => '1',
            'category_id' => '1',
            'subcategory_id' => '1',
            'subcategories' => '1',
            'code' => 'B0002',
            'name' => 'LOREANNA',
            'image_path1' => 'loreanna_foto1.jpeg',
            'image_path2' => 'loreanna_foto2.jpeg',
            'image_path3' => 'loreanna_foto3.jpeg',
            'image_path4' => '',
            'video_path1' => '',
            'manufacturer_id' => '1',
            'details1' => '',
            'condition' => '',
            'matricula' => 'AGSP-PE-0171',
            'distintivollamada' => 'YYP-2.888',
            'nroomi' => '8686939',
            'nrommsi' => '775993069',
            'armador' => 'LOREANNA PESCA C.A.',
            'eslora' => '21,65 MTS',
            'manga' => '6,3 MTS',
            'puntal' => '3,8 MTS',
            'arqueobruto' => '132,68 MTS',
            'arqueoneto' => '59,71 MTS',
            'capacidadcombustible' => '75.000 LTS',
            'capacidadalmacenamiento' => '30 TON',
            'power' => '720 HP',
            'puertoregistro' => 'PUERTO LA CRUZ',
            'artepesca' => 'PALANGRE ATUNERO',
            'fe_fabricacion' => '1972',
            'color' => '',
            'material' => '',
            'maximumcrew' => '',
            'nroengines' => '',
            'anno_motor' => '',
            'enginebrand' => '',
            'enginemodel' => '',
            'enginetype' => '',
            'hoursofuse' => '',
            'estereo' => '',
            'negotiable' => '',
            'additional_information' => '',
            'currency' => '',
            'price1' => '750',
            'price2' => '1',
            'price_offer' => '1',
            'price_divisa' => '1',
            'stock_min' => '1',
            'stock_max' => '1',
            'stock' => '1',
            'in_pickup' => '0',
            'in_delivery' => '0',
            'in_envio_nacional' => '0',
            'madein' => '',
            'in_pedido' => '0',
            'in_offer' => '0',
            'ca_valoracion' => '5',
            'in_valido' => '1',
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('embarcacions')->insert([
            'area_id' => '3',
            'user_id' => '1',
            'comercio_id' => '1',
            'category_id' => '1',
            'subcategory_id' => '1',
            'subcategories' => '1',
            'code' => 'B0003',
            'name' => 'CARMEN ROSA',
            'image_path1' => 'carmenrosa_foto1.jpeg',
            'image_path2' => 'carmenrosa_foto2.jpeg',
            'image_path3' => 'carmenrosa_foto3.jpeg',
            'image_path4' => 'carmenrosa_foto4.jpeg',
            'video_path1' => '',
            'manufacturer_id' => '1',
            'details1' => '',
            'condition' => '',
            'matricula' => 'ARSI-PE-0065',
            'distintivollamada' => 'YYP-5.816',
            'nroomi' => '8686941',
            'nrommsi' => '775993502',
            'armador' => 'LORIPESCA C.A.',
            'eslora' => '21 MTS',
            'manga' => '5,8 MTS',
            'puntal' => '3,1 MTS',
            'arqueobruto' => '132,03 MTS',
            'arqueoneto' => '59,42 MTS',
            'capacidadcombustible' => '60.000 LTS',
            'capacidadalmacenamiento' => '30 TON',
            'power' => '650 HP',
            'puertoregistro' => 'GUIRIA',
            'artepesca' => 'PALANGRE ATUNERO',
            'fe_fabricacion' => '1982',
            'color' => '',
            'material' => '',
            'maximumcrew' => '',
            'nroengines' => '',
            'anno_motor' => '',
            'enginebrand' => '',
            'enginemodel' => '',
            'enginetype' => '',
            'hoursofuse' => '',
            'estereo' => '',
            'negotiable' => '',
            'additional_information' => '',
            'currency' => '',
            'price1' => '700',
            'price2' => '1',
            'price_offer' => '1',
            'price_divisa' => '1',
            'stock_min' => '1',
            'stock_max' => '1',
            'stock' => '1',
            'in_pickup' => '0',
            'in_delivery' => '0',
            'in_envio_nacional' => '0',
            'madein' => '',
            'in_pedido' => '0',
            'in_offer' => '0',
            'ca_valoracion' => '5',
            'in_valido' => '1',
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('embarcacions')->insert([
            'area_id' => '3',
            'user_id' => '1',
            'comercio_id' => '1',
            'category_id' => '1',
            'subcategory_id' => '1',
            'subcategories' => '1',
            'code' => 'B0004',
            'name' => 'LORELLA',
            'image_path1' => 'lorella_foto1.jpeg',
            'image_path2' => 'lorella_foto2.jpeg',
            'image_path3' => 'lorella_foto3.jpeg',
            'image_path4' => 'lorella_foto4.jpeg',
            'video_path1' => '',
            'manufacturer_id' => '1',
            'details1' => '',
            'condition' => '',
            'matricula' => 'APNN-PE-0194',
            'distintivollamada' => 'YYP-2.243',
            'nroomi' => '',
            'nrommsi' => '775993336',
            'armador' => 'PESQUERO MAR C.A.',
            'eslora' => '25,25 MTS',
            'manga' => '6,9 MTS',
            'puntal' => '3,55 MTS',
            'arqueobruto' => '129,72 MTS',
            'arqueoneto' => '38,92 MTS',
            'capacidadcombustible' => '70.000 LTS',
            'capacidadalmacenamiento' => '30 TON',
            'power' => '850 HP',
            'puertoregistro' => 'PUERTO SUCRE',
            'artepesca' => 'PALANGRE ATUNERO',
            'fe_fabricacion' => '1972',
            'color' => '',
            'material' => '',
            'maximumcrew' => '',
            'nroengines' => '',
            'anno_motor' => '',
            'enginebrand' => '',
            'enginemodel' => '',
            'enginetype' => '',
            'hoursofuse' => '',
            'estereo' => '',
            'negotiable' => '',
            'additional_information' => '',
            'currency' => '',
            'price1' => '700',
            'price2' => '1',
            'price_offer' => '1',
            'price_divisa' => '1',
            'stock_min' => '1',
            'stock_max' => '1',
            'stock' => '1',
            'in_pickup' => '0',
            'in_delivery' => '0',
            'in_envio_nacional' => '0',
            'madein' => '',
            'in_pedido' => '0',
            'in_offer' => '0',
            'ca_valoracion' => '5',
            'in_valido' => '1',
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('embarcacions')->insert([
            'area_id' => '3',
            'user_id' => '1',
            'comercio_id' => '1',
            'category_id' => '1',
            'subcategory_id' => '1',
            'subcategories' => '1',
            'code' => 'B0004',
            'name' => 'OCEANO NORTE',
            'image_path1' => 'oceanonorte_foto1.jpeg',
            'image_path2' => 'oceanonorte_foto2.jpeg',
            'image_path3' => '',
            'image_path4' => '',
            'video_path1' => '',
            'manufacturer_id' => '1',
            'details1' => '',
            'condition' => '',
            'matricula' => '',
            'distintivollamada' => '',
            'nroomi' => '',
            'nrommsi' => '',
            'armador' => '',
            'eslora' => ' MTS',
            'manga' => ' MTS',
            'puntal' => ' MTS',
            'arqueobruto' => ' MTS',
            'arqueoneto' => ' MTS',
            'capacidadcombustible' => ' LTS',
            'capacidadalmacenamiento' => ' TON',
            'power' => ' HP',
            'puertoregistro' => '',
            'artepesca' => '',
            'fe_fabricacion' => '',
            'color' => '',
            'material' => '',
            'maximumcrew' => '',
            'nroengines' => '',
            'anno_motor' => '',
            'enginebrand' => '',
            'enginemodel' => '',
            'enginetype' => '',
            'hoursofuse' => '',
            'estereo' => '',
            'negotiable' => '',
            'additional_information' => '',
            'currency' => '',
            'price1' => '600',
            'price2' => '1',
            'price_offer' => '1',
            'price_divisa' => '1',
            'stock_min' => '1',
            'stock_max' => '1',
            'stock' => '1',
            'in_pickup' => '0',
            'in_delivery' => '0',
            'in_envio_nacional' => '0',
            'madein' => '',
            'in_pedido' => '0',
            'in_offer' => '0',
            'ca_valoracion' => '5',
            'in_valido' => '1',
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        
    }
}
