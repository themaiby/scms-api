<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Vendor
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $user_id
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Vendor newModelQuery()
 * @method static Builder|Vendor newQuery()
 * @method static Builder|Vendor query()
 * @method static Builder|Vendor whereActive($value)
 * @method static Builder|Vendor whereCreatedAt($value)
 * @method static Builder|Vendor whereDescription($value)
 * @method static Builder|Vendor whereId($value)
 * @method static Builder|Vendor whereName($value)
 * @method static Builder|Vendor whereUpdatedAt($value)
 * @method static Builder|Vendor whereUserId($value)
 * @mixin Eloquent
 * @property int $components_count
 * @property float $components_cost
 * @method static Builder|Vendor whereComponentsCost($value)
 * @method static Builder|Vendor whereComponentsCount($value)
 */
class Vendor extends Model
{
    protected $table = 'vendors';
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'components_count',
        'components_cost',
        'active',
        'created_at',
        'updated_at'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
