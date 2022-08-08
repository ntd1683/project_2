<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SeatTypeEnum extends Enum
{
    public const SEAT = 0;
    public const BED_CHAIR = 1;

    public static function getArrayView(): array
    {
        return [
            'Ghế ngồi' => self::SEAT,
            'Giường nằm' => self::BED_CHAIR,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
