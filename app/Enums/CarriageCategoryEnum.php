<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CarriageCategoryEnum extends Enum
{
    public const NORMAL = 0;
    public const VIP = 1;

    public static function getArrayView(): array
    {
        return [
            'Thường' => self::NORMAL,
            'VIP' => self::VIP,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
