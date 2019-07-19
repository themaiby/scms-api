<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\VendorContact
 *
 * @property int $id
 * @property int $vendor_id
 * @property string $title
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Vendor $vendor
 * @method static Builder|VendorContact newModelQuery()
 * @method static Builder|VendorContact newQuery()
 * @method static Builder|VendorContact query()
 * @method static Builder|VendorContact whereCreatedAt($value)
 * @method static Builder|VendorContact whereId($value)
 * @method static Builder|VendorContact whereTitle($value)
 * @method static Builder|VendorContact whereUpdatedAt($value)
 * @method static Builder|VendorContact whereValue($value)
 * @method static Builder|VendorContact whereVendorId($value)
 * @mixin Eloquent
 */
class VendorContact extends Model
{
    protected $table = 'vendor_contacts';
    protected $fillable = ['title', 'value'];

    /**
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
