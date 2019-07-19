<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorCreateRequest extends FormRequest
{
    public const FIELD_NAME = 'name';
    public const FIELD_DESCRIPTION = 'description';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::FIELD_NAME => 'required',
            self::FIELD_DESCRIPTION => 'string',
        ];
    }
}
