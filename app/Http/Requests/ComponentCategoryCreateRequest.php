<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComponentCategoryCreateRequest extends FormRequest
{
    public const FIELD_NAME = 'name';
    public const FIELD_PARENT_ID = 'parent_id';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::FIELD_NAME => 'required|unique_with:component_categories,parent_id',
            self::FIELD_PARENT_ID => 'required|numeric|exists:component_categories,id',
        ];
    }
}
