<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderTypeCreateRequest extends FormRequest
{
    public const FIELD_TITLE = 'title';
    public const FIELD_COLOR = 'color';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::FIELD_TITLE => 'required',
            self::FIELD_COLOR => 'sometimes',
        ];
    }
}
