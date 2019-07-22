<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public const FIELD_EMAIL = 'email';
    public const FIELD_PASSWORD = 'password';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::FIELD_EMAIL => 'required|email',
            self::FIELD_PASSWORD => 'required',
        ];
    }
}
