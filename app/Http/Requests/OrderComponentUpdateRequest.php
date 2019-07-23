<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderComponentUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return ['quantity' => 'required|numeric|min:1'];
    }
}
