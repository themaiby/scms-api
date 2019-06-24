<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Component
 *
 * @property int $id
 * @property int $component_category_id
 * @property int $user_id
 * @property int $vendor_id
 * @property string $title
 * @property string $vendor_code
 * @property int $quantity
 * @property float $price
 * @property float|null $cost
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read ComponentCategory $category
 * @method static Builder|Component newModelQuery()
 * @method static Builder|Component newQuery()
 * @method static Builder|Component query()
 * @method static Builder|Component whereActive($value)
 * @method static Builder|Component whereComponentCategoryId($value)
 * @method static Builder|Component whereCost($value)
 * @method static Builder|Component whereCreatedAt($value)
 * @method static Builder|Component whereId($value)
 * @method static Builder|Component wherePrice($value)
 * @method static Builder|Component whereQuantity($value)
 * @method static Builder|Component whereTitle($value)
 * @method static Builder|Component whereUpdatedAt($value)
 * @method static Builder|Component whereUserId($value)
 * @method static Builder|Component whereVendorCode($value)
 * @method static Builder|Component whereVendorId($value)
 * @mixin Eloquent
 * @property-read Vendor $vendor
 */
class Component extends Model
{
    protected $table = 'components';
    protected $fillable = [
        'component_category_id', 'user_id', 'vendor_id',
        'title', 'vendor_code', 'quantity', 'price', 'cost', 'active', 'created_at', 'updated_at'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ComponentCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
