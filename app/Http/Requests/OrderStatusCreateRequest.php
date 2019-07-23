<?php

namespace App\Http\Requests;

use App\Enums\OrderStatusType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStatusCreateRequest extends FormRequest
{
    public const FIELD_TITLE = 'title';
    public const FIELD_COLOR = 'color';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_TYPE = 'type';

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            self::FIELD_TITLE => 'required|unique:order_statuses,title',
            self::FIELD_DESCRIPTION => 'sometimes',
            self::FIELD_COLOR => 'sometimes',
            self::FIELD_TYPE => [
                'required',
                Rule::in(OrderStatusType::getValues())],
        ];
    }
}
