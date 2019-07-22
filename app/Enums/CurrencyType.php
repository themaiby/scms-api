<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static UAH()
 * @method static static USD()
 * @method static static EUR()
 * @method static static RUB()
 */
final class CurrencyType extends Enum
{
    public const UAH = 'UAH';
    public const USD = 'USD';
    public const EUR = 'EUR';
    public const RUB = 'RUB';
}
