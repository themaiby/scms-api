<?php

use App\Enums\OrderStatusType;
use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::insert([
            [
                'title' => __('orders.statuses.new'),
                'color' => 'primary',
                'description' => 'To Do',
                'type' => OrderStatusType::OPENER(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => __('orders.statuses.in_work'),
                'color' => 'primary',
                'description' => 'To Do',
                'type' => OrderStatusType::NORMAL(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => __('orders.statuses.at_partner'),
                'color' => 'primary',
                'description' => 'To Do',
                'type' => OrderStatusType::MOVER(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => __('orders.statuses.wait_for_component'),
                'color' => 'primary',
                'description' => 'To Do',
                'type' => OrderStatusType::NORMAL(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => __('orders.statuses.repair_decline'),
                'color' => 'primary',
                'description' => 'To Do',
                'type' => OrderStatusType::NORMAL(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => __('orders.statuses.warranty_decline'),
                'color' => 'primary',
                'description' => 'To Do',
                'type' => OrderStatusType::NORMAL(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => __('orders.statuses.ready'),
                'color' => 'primary',
                'description' => 'To Do',
                'type' => OrderStatusType::NORMAL(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => __('orders.statuses.done'),
                'color' => 'primary',
                'description' => 'To Do',
                'type' => OrderStatusType::CLOSER(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => __('orders.statuses.closed_other'),
                'color' => 'primary',
                'description' => 'To Do',
                'type' => OrderStatusType::CLOSER(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
