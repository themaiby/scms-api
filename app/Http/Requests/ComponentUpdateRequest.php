<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComponentUpdateRequest extends FormRequest
{
    public const FIELD_COMPONENT_CATEGORY_ID = 'component_category_id';
    public const FIELD_VENDOR_ID = 'vendor_id';
    public const FIELD_TITLE = 'title';
    public const FIELD_VENDOR_CODE = 'vendor_code';
    public const FIELD_QUANTITY = 'quantity';
    public const FIELD_PRICE = 'price';
    public const FIELD_CURRENCY = 'currency';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::FIELD_COMPONENT_CATEGORY_ID => 'sometimes|numeric|exists:component_categories,id',
            self::FIELD_VENDOR_ID => 'sometimes|numeric|exists:vendors,id',
            self::FIELD_TITLE => 'sometimes',
            self::FIELD_VENDOR_CODE => 'sometimes',
            self::FIELD_QUANTITY => 'sometimes|numeric',
            self::FIELD_PRICE => 'sometimes|numeric',
            self::FIELD_CURRENCY => 'exists:exchange_rates,code|required_with:' . self::FIELD_PRICE,
        ];
    }
}
