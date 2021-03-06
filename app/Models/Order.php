<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $order_status_id
 * @property int $order_type_id
 * @property string $client_name
 * @property string $client_number
 * @property string|null $client_description
 * @property string $device_name
 * @property string $device_code
 * @property string|null $device_description
 * @property string $order_reason
 * @property string $finish_date
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereActive($value)
 * @method static Builder|Order whereClientDescription($value)
 * @method static Builder|Order whereClientName($value)
 * @method static Builder|Order whereClientNumber($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDeviceCode($value)
 * @method static Builder|Order whereDeviceDescription($value)
 * @method static Builder|Order whereDeviceName($value)
 * @method static Builder|Order whereFinishDate($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereOrderReason($value)
 * @method static Builder|Order whereOrderStatusId($value)
 * @method static Builder|Order whereOrderTypeId($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 * @mixin Eloquent
 * @property int $status_id
 * @property int $type_id
 * @property int|null $partner_id
 * @method static Builder|Order wherePartnerId($value)
 * @method static Builder|Order whereStatusId($value)
 * @method static Builder|Order whereTypeId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderComponent[] $components
 * @property-read \App\Models\Partner|null $partner
 * @property-read \App\Models\OrderStatus $status
 * @property-read \App\Models\OrderType $type
 * @property-read \App\Models\User $user
 */
class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'status_id', 'type_id', 'partner_id',
        'client_name', 'client_number', 'client_description',
        'device_name', 'device_code', 'device_description',
        'order_reason', 'finish_date'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function components(): HasMany
    {
        return $this->hasMany(OrderComponent::class);
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(OrderType::class);
    }

    /**
     * @return BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
}
