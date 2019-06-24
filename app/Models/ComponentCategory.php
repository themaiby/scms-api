<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\ComponentCategory
 *
 * @method static Builder|ComponentCategory newModelQuery()
 * @method static Builder|ComponentCategory newQuery()
 * @method static Builder|ComponentCategory query()
 * @mixin Eloquent
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ComponentCategory whereCreatedAt($value)
 * @method static Builder|ComponentCategory whereId($value)
 * @method static Builder|ComponentCategory whereName($value)
 * @method static Builder|ComponentCategory whereUpdatedAt($value)
 * @property-read Collection|Component[] $component
 */
class ComponentCategory extends Model
{
    protected $table = 'component_categories';

    /**
     * @return HasMany
     */
    public function component(): HasMany
    {
        return $this->hasMany(Component::class);
    }
}
