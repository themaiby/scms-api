<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property-read Collection|Component[] $components
 * @property-read Collection|VendorContact[] $contacts
 */
class Vendor extends Model
{
    protected $table = 'vendors';
    protected $fillable = ['name', 'description'];

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
        return $this->hasMany(Component::class);
    }

    /**
     * @return HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(VendorContact::class);
    }
}
