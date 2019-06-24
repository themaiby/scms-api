<?php

namespace App\Observers;

use App\Models\Component;
use App\Services\ComponentService;

class ComponentObserver
{
    /**
     * @var ComponentService
     */
    protected $componentService;

    public function __construct(ComponentService $componentService)
    {
        $this->componentService = $componentService;
    }

    /**
     * Handle the component "created" event.
     *
     * @param Component $component
     * @return void
     */
    public function created(Component $component): void
    {
        $this->componentService->calculateComponentCost($component);
    }

    /**
     * Handle the component "updated" event.
     *
     * @param Component $component
     * @return void
     */
    public function updated(Component $component): void
    {
        if (($component->price * $component->quantity) !== $component->cost) {
            $this->componentService->calculateComponentCost($component);
        }

        $this->componentService->calculateVendorSummaryData($component);
    }

    /**
     * Handle the component "deleted" event.
     *
     * @param Component $component
     * @return void
     */
    public function deleted(Component $component)
    {
        $this->componentService->calculateVendorSummaryData($component);
    }

    /**
     * Handle the component "restored" event.
     *
     * @param Component $component
     * @return void
     */
    public function restored(Component $component)
    {
        //
    }

    /**
     * Handle the component "force deleted" event.
     *
     * @param Component $component
     * @return void
     */
    public function forceDeleted(Component $component)
    {
        //
    }
}
