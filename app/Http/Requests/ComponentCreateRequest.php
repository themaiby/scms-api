<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComponentCreateRequest extends FormRequest
{
    public const FIELD_COMPONENT_CATEGORY_ID = 'component_category_id';
    public const FIELD_VENDOR_ID = 'vendor_id';
    public const FIELD_TITLE = 'title';
    public const FIELD_VENDOR_CODE = 'vendor_code';
    public const FIELD_QUANTITY = 'quantity';
    public const FIELD_PRICE = 'price';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::FIELD_COMPONENT_CATEGORY_ID => 'required|numeric|exists:component_categories,id',
            self::FIELD_VENDOR_ID => 'required|numeric|exists:vendors,id',
            self::FIELD_TITLE => 'required',
            self::FIELD_VENDOR_CODE => 'required',
            self::FIELD_QUANTITY => 'numeric',
            self::FIELD_PRICE => 'numeric',
        ];
    }
}
