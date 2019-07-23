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
 * @property int|null $parent_id
 * @property-read \App\Models\ComponentCategory $child
 * @property-read \App\Models\ComponentCategory|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComponentCategory whereParentId($value)
 */
class ComponentCategory extends Model
{
    protected $table = 'component_categories';
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function component(): HasMany
    {
        return $this->hasMany(Component::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    /**
     * @return HasMany
     *
     */
    public function oneChild(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function child(): HasMany
    {
        return $this->oneChild()->with('child');
    }
}
