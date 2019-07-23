<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\OrderType
 *
 * @property int $id
 * @property string $title
 * @property string $color
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|OrderType newModelQuery()
 * @method static Builder|OrderType newQuery()
 * @method static Builder|OrderType query()
 * @method static Builder|OrderType whereColor($value)
 * @method static Builder|OrderType whereCreatedAt($value)
 * @method static Builder|OrderType whereId($value)
 * @method static Builder|OrderType whereTitle($value)
 * @method static Builder|OrderType whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OrderType extends Model
{
    protected $table = 'order_types';
    protected $fillable = ['title', 'color'];
}
