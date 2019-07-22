<?php


namespace App\Services\API;


use App\Models\ExchangeRate;
use GuzzleHttp\Client;

class ExchangeAPIService
{
    public const BASE_URL = 'https://api.exchangerate-api.com/v4/latest/' . ExchangeRate::BASE_CURRENCY;

    public static function updateRates(): void
    {
        $client = new Client();
        $res = $client->get(self::BASE_URL);
        $data = json_decode($res->getBody()->getContents(), true);
        $rates = [];

        foreach ($data['rates'] as $code => $rate) {
            $rates[] = ['code' => $code, 'rate' => $rate, 'created_at' => now(), 'updated_at' => now()];
        }

        ExchangeRate::insert($rates);
    }
}
