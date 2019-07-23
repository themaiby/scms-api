<?php

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
            ComponentCategoriesSeeder::class,
            PermissionSeeder::class,
            AdministratorSeeder::class,
            ExchangeRatesSeeder::class,
            OrderStatusTypesSeeder::class,
        ]);
    }
}
