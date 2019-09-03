<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Kyslik\ColumnSortable\Sortable;

/**
 * App\Models\Partner
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $user_id
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Partner newModelQuery()
 * @method static Builder|Partner newQuery()
 * @method static Builder|Partner query()
 * @method static Builder|Partner whereActive($value)
 * @method static Builder|Partner whereCreatedAt($value)
 * @method static Builder|Partner whereDescription($value)
 * @method static Builder|Partner whereId($value)
 * @method static Builder|Partner whereName($value)
 * @method static Builder|Partner whereUpdatedAt($value)
 * @method static Builder|Partner whereUserId($value)
 * @mixin Eloquent
 * @property-read Collection|PartnerContact[] $contacts
 * @property-read Collection|Order[] $orders
 * @method static Builder|Partner sortable($defaultParameters = null)
 */
class Partner extends Model
{
    use Sortable;

    protected $table = 'partners';
    protected $fillable = ['name', 'description'];
    protected $sortable = ['id', 'name', 'description', 'created_at'];

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(PartnerContact::class);
    }
}
