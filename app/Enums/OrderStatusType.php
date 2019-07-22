<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OPENER()
 * @method static static MOVER()
 * @method static static CLOSER()
 */
final class OrderStatusType extends Enum
{
    public const OPENER = 'OPENER';
    public const MOVER = 'MOVER';
    public const CLOSER = 'CLOSER';
}
