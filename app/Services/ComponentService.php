<?php

namespace App\Services;

use App\Enums\CurrencyType;
use App\Http\Requests\ComponentCreateRequest;
use App\Http\Requests\ComponentUpdateRequest;
use App\Models\Component;
use App\Models\ExchangeRate;
use App\Models\Vendor;
use Auth;
use Illuminate\Http\Request;

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

        return $component;
    }

    /**
     * @param ComponentCreateRequest $request
     * @return Component
     */
    public function createComponent(ComponentCreateRequest $request): Component
    {
        $data = array_merge(
            $request->all(),
            [
                'user_id' => Auth::id(),
                'price' => $this->getConvertedPrice($request)
            ]
        );

        return Component::create($data);
    }

    /**
     * @param Component $component
     * @param ComponentUpdateRequest $request
     * @return Component
     */
    public function updateComponent(Component $component, ComponentUpdateRequest $request): Component
    {
        $data = $request->only([
            ComponentUpdateRequest::FIELD_COMPONENT_CATEGORY_ID,
            ComponentUpdateRequest::FIELD_VENDOR_ID,
            ComponentUpdateRequest::FIELD_TITLE,
            ComponentUpdateRequest::FIELD_VENDOR_CODE,
            ComponentUpdateRequest::FIELD_QUANTITY,
            ComponentUpdateRequest::FIELD_PRICE,
        ]);
        $dataWithExchange = array_merge($data, ['price' => $this->getConvertedPrice($request)]);
        $component->update($dataWithExchange);

        return $component->load(['vendor']);
    }

    /**
     * @param Request $request
     * @return float
     */
    private function getConvertedPrice(Request $request): float
    {
        $currency = $request->get('currency');
        $price = $request->get('price');

        if ($currency && $price) {
            return ExchangeRate::convertToBase(
                CurrencyType::getInstances()[$currency],
                $price
            );
        }

        return 0;
    }
}
