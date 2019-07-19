<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorContactCreateRequest extends FormRequest
{
    public const FIELD_CONTACT_TITLE = 'title';
    public const FIELD_CONTACT_VALUE = 'value';

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            self::FIELD_CONTACT_TITLE => 'required',
            self::FIELD_CONTACT_VALUE => 'required',
        ];
    }
}
