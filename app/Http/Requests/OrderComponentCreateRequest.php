<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderComponentCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric|min:1',
            'component_id' => 'required|exists:components,id'
        ];
    }
}
