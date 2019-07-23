<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PartnerContact
 *
 * @property int $id
 * @property int $partner_id
 * @property string $title
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PartnerContact newModelQuery()
 * @method static Builder|PartnerContact newQuery()
 * @method static Builder|PartnerContact query()
 * @method static Builder|PartnerContact whereCreatedAt($value)
 * @method static Builder|PartnerContact whereId($value)
 * @method static Builder|PartnerContact wherePartnerId($value)
 * @method static Builder|PartnerContact whereTitle($value)
 * @method static Builder|PartnerContact whereUpdatedAt($value)
 * @method static Builder|PartnerContact whereValue($value)
 * @mixin Eloquent
 */
class PartnerContact extends Model
{
    protected $table = 'partner_contacts';
    protected $fillable = ['title', 'value'];
}
