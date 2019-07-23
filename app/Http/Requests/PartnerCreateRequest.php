<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerCreateRequest extends FormRequest
{
    public const FIELD_NAME = 'name';
    public const FIELD_DESCRIPTION = 'description';

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            self::FIELD_NAME => 'required',
            self::FIELD_DESCRIPTION => 'sometimes',
        ];
    }
}
