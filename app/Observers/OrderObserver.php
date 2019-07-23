<?php

namespace App\Observers;

use App\Enums\OrderStatusType;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param Order $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * Handle the order "updated" event.
     *
     * @param Order $order
     * @return void
     */
    public function updated(Order $order): void
    {
        if ($order->status->type !== OrderStatusType::MOVER) {
            Order::unsetEventDispatcher();
            $order->update(['partner_id' => null]);
        }
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param Order $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param Order $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param Order $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
