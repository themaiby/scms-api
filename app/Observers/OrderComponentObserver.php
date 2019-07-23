<?php

namespace App\Observers;

use App\Models\OrderComponent;

class OrderComponentObserver
{
    /**
     * Handle the order component "created" event.
     *
     * @param OrderComponent $orderComponent
     * @return void
     */
    public function created(OrderComponent $orderComponent): void
    {
        OrderComponent::unsetEventDispatcher();

        $sourceComponent = $orderComponent->sourceComponent;
        $sourceComponent->update(['quantity' => $sourceComponent->quantity - $orderComponent->quantity]);
    }

    /**
     * Handle the order component "updated" event.
     *
     * @param OrderComponent $orderComponent
     * @return void
     */
    public function updated(OrderComponent $orderComponent): void
    {
        OrderComponent::unsetEventDispatcher();

        $sourceComponent = $orderComponent->sourceComponent;
        $newQuantity = $sourceComponent->quantity + $orderComponent->getOriginal('quantity') - $orderComponent->quantity;
        $sourceComponent->update([
            'quantity' => $newQuantity
        ]);
    }

    /**
     * Handle the order component "deleted" event.
     *
     * @param OrderComponent $orderComponent
     * @return void
     */
    public function deleted(OrderComponent $orderComponent): void
    {
        OrderComponent::unsetEventDispatcher();

        $sourceComponent = $orderComponent->sourceComponent;
        $sourceComponent->update(['quantity' => $sourceComponent->quantity + $orderComponent->quantity]);
    }

    /**
     * Handle the order component "restored" event.
     *
     * @param OrderComponent $orderComponent
     * @return void
     */
    public function restored(OrderComponent $orderComponent): void
    {
        //
    }

    /**
     * Handle the order component "force deleted" event.
     *
     * @param OrderComponent $orderComponent
     * @return void
     */
    public function forceDeleted(OrderComponent $orderComponent): void
    {
        $this->deleted($orderComponent);
    }
}
