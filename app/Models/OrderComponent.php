<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OrderComponent
 *
 * @property int $id
 * @property int $order_id
 * @property int $component_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Component $sourceComponent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderComponent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderComponent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderComponent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderComponent whereComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderComponent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderComponent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderComponent whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderComponent whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderComponent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderComponent extends Model
{
    protected $table = 'order_components';

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function sourceComponent(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }
}
