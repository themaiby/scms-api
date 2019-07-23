<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\OrderComponent
 *
 * @property int $id
 * @property int $order_id
 * @property int $component_id
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Order $order
 * @property-read Component $sourceComponent
 * @method static Builder|OrderComponent newModelQuery()
 * @method static Builder|OrderComponent newQuery()
 * @method static Builder|OrderComponent query()
 * @method static Builder|OrderComponent whereComponentId($value)
 * @method static Builder|OrderComponent whereCreatedAt($value)
 * @method static Builder|OrderComponent whereId($value)
 * @method static Builder|OrderComponent whereOrderId($value)
 * @method static Builder|OrderComponent whereQuantity($value)
 * @method static Builder|OrderComponent whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OrderComponent extends Model
{
    protected $table = 'order_components';
    protected $fillable = ['component_id', 'quantity'];

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
        return $this->belongsTo(Component::class, 'component_id');
    }
}
