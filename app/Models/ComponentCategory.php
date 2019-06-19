<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ComponentCategory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComponentCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComponentCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComponentCategory query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComponentCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComponentCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComponentCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ComponentCategory whereUpdatedAt($value)
 */
class ComponentCategory extends Model
{
    protected $table = 'component_categories';
}
