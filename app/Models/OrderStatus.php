<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\OrderStatus
 *
 * @property int $id
 * @property string $title
 * @property string $color
 * @property string|null $description
 * @property string $type
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Order[] $order
 * @method static Builder|OrderStatus newModelQuery()
 * @method static Builder|OrderStatus newQuery()
 * @method static Builder|OrderStatus query()
 * @method static Builder|OrderStatus whereActive($value)
 * @method static Builder|OrderStatus whereColor($value)
 * @method static Builder|OrderStatus whereCreatedAt($value)
 * @method static Builder|OrderStatus whereDescription($value)
 * @method static Builder|OrderStatus whereId($value)
 * @method static Builder|OrderStatus whereTitle($value)
 * @method static Builder|OrderStatus whereType($value)
 * @method static Builder|OrderStatus whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OrderStatus extends Model
{
    protected $table = 'order_statuses';
    protected $fillable = ['title', 'color', 'description', 'type'];

    /**
     * @return HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
