<?php

use App\Services\API\ExchangeAPIService;
use Illuminate\Database\Seeder;

class ExchangeRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExchangeAPIService::updateRates();
    }
}
