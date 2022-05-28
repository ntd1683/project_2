<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SeatType extends Enum
{
    public const SEAT = 0;
    public const BED_CHAIR = 1;
}
