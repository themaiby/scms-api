<?php

namespace App\Models;

use App\Enums\CurrencyType;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ExchangeRate
 *
 * @property int $id
 * @property string $code
 * @property float $rate
 * @property string $base
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ExchangeRate newModelQuery()
 * @method static Builder|ExchangeRate newQuery()
 * @method static Builder|ExchangeRate query()
 * @method static Builder|ExchangeRate whereBase($value)
 * @method static Builder|ExchangeRate whereCode($value)
 * @method static Builder|ExchangeRate whereCreatedAt($value)
 * @method static Builder|ExchangeRate whereId($value)
 * @method static Builder|ExchangeRate whereRate($value)
 * @method static Builder|ExchangeRate whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ExchangeRate extends Model
{
    public const BASE_CURRENCY = 'USD';

    protected $table = 'exchange_rates';

    /**
     * @param CurrencyType $target
     * @param float $quantity
     * @return float
     */
    public static function convertFromBase(CurrencyType $target, float $quantity): float
    {
        $exchange = self::where('code', $target)->latest()->first();
        return $quantity * $exchange->rate;
    }

    /**
     * @param CurrencyType $source
     * @param float $quantity
     * @return float
     */
    public static function convertToBase(CurrencyType $source, float $quantity): float
    {
        $exchange = self::where('code', $source)->latest()->first();
        return $quantity / $exchange->rate;
    }

    /**
     * @param CurrencyType $source
     * @param CurrencyType $target
     * @param float $quantity
     * @return float
     */
    public static function convert(CurrencyType $source, CurrencyType $target, float $quantity): float
    {
        $quantityInBase = self::convertToBase($source, $quantity);
        return self::convertFromBase($target, $quantityInBase);
    }
}
