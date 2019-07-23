<?php

use App\Models\OrderType;
use Illuminate\Database\Seeder;

class OrderTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderType::insert([
            ['title' => __('orders.types.paid'), 'color' => 'primary'],
            ['title' => __('orders.types.warranty'), 'color' => 'secondary'],
        ]);
    }
}
