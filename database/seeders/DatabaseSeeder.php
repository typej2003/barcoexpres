<?php

namespace Database\Seeders;

use App\Models\Embarcacion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            BancoSeeder::class,
            SettingsSeeder::class,
            MetodoPagoSeeder::class,
            AreaSeeder::class,
            ComercioSeeder::class,
            ManufacturersSeeder::class,
            SettingComercioSeeder::class,
            ImpuestoSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            SupplierSeeder::class,
            EmbarcacionSeeder::class,
            ValoracionBoatsSeeder::class,
            MenuSeeder::class,
            MetodoPagoComercioSeeder::class,
        ]);
    }
}
