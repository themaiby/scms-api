<?php

namespace App\Console\Commands;

use App\Services\API\ExchangeAPIService;
use Illuminate\Console\Command;

class UpdateExchangeRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download latest currency exchange rates';

    public function handle(): void
    {
        ExchangeAPIService::updateRates();
    }
}
