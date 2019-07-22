<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComponentCategoryUpdateRequest extends FormRequest
{
    public const FIELD_NAME = 'name';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::FIELD_NAME => 'required|unique_with:component_categories,parent_id',
        ];
    }
}
