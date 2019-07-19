<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatusType extends Enum
{
    public const OPENER = 'OPENER';
    public const MOVER = 'MOVER';
    public const CLOSER = 'CLOSER';
}
