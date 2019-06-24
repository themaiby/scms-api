<?php

namespace App\Services;

use App\Models\Component;
use App\Models\Vendor;

class ComponentService
{
    /**
     * @param Component $component
     * @return Component
     */
    public function calculateComponentCost(Component $component): Component
    {
        $component->update(['cost' => $component->quantity * $component->price]);
        return $component;
    }

    /**
     * Calculating vendor summary data based on given component
     * todo: test
     * @param Component $component
     * @return Component
     */
    public function calculateVendorSummaryData(Component $component): Component
    {
        $components = Component::where('vendor_id', $component->vendor_id);

        $vendorBuilder = $component->vendor();
        $vendorBuilder->update([
            'components_count' => $components->count(),
            'components_cost' => $components->sum('cost')
        ]);

        /** Calculating OLD vendor if we have changed vendor_id */
        $originalVendorID = $component->getOriginal('vendor_id');
        if (($originalVendorID !== null) && ($component->vendor_id !== $originalVendorID)) {
            $componentsForOriginalVendor = Component::where('vendor_id', $originalVendorID);
            $originalVendorBuilder = Vendor::find($originalVendorID);
            $originalVendorBuilder->update([
                'components_count' => $componentsForOriginalVendor->count(),
                'components_cost' => $componentsForOriginalVendor->sum('cost'),
            ]);
        }

        return $component->load('vendor');
    }
}
