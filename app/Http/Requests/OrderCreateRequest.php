<?php

namespace App\Http\Requests;

use App\Enums\OrderStatusType;
use App\Models\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderCreateRequest extends FormRequest
{
    public const FIELD_STATUS_ID = 'status_id'; // with default value in DB
    public const FIELD_TYPE_ID = 'type_id';
    public const FIELD_PARTNER_ID = 'partner_id'; // if status->type === mover
    public const FIELD_CLIENT_NAME = 'client_name';
    public const FIELD_CLIENT_NUMBER = 'client_number';
    public const FIELD_CLIENT_DESCRIPTION = 'client_description';
    public const FIELD_DEVICE_NAME = 'device_name';
    public const FIELD_DEVICE_CODE = 'device_code';
    public const FIELD_DEVICE_DESCRIPTION = 'device_description';
    public const FIELD_ORDER_REASON = 'order_reason';
    public const FIELD_FINISH_DATE = 'finish_date'; // today + 2 days

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
        $statusType = OrderStatus::find($this->get(self::FIELD_STATUS_ID))->type ?? 0;

        return [
            self::FIELD_STATUS_ID => 'required|numeric|exists:order_statuses,id',
            self::FIELD_TYPE_ID => 'required|numeric|exists:order_types,id',
            self::FIELD_CLIENT_NAME => 'required',
            self::FIELD_CLIENT_NUMBER => 'required', // todo: backend validation
            self::FIELD_CLIENT_DESCRIPTION => 'sometimes',
            self::FIELD_DEVICE_NAME => 'required',
            self::FIELD_DEVICE_CODE => 'required',
            self::FIELD_DEVICE_DESCRIPTION => 'sometimes',
            self::FIELD_ORDER_REASON => 'required',
            self::FIELD_FINISH_DATE => 'date',
            self::FIELD_PARTNER_ID => [
                'exists:partners,id',
                Rule::requiredIf(static function () use ($statusType) {
                    // if status is mover
                    return $statusType === OrderStatusType::MOVER;
                })
            ],
        ];
    }
}
