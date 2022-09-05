<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CarriageColorEnum extends Enum
{
    public const PURPLE = 0;
    public const PINK = 1;
    public const BLUE = 2;
    public const CYAN = 3;
    public const GREEN = 4;
    public const YELLOW = 5;
    public const ORANGE = 6;
    public const VOLCANO = 7;
    public const GREY = 8;

    public static function getArrayView(): array
    {
        return [
            'purple' => self::PURPLE,
            'pink' => self::PINK,
            'blue' => self::BLUE,
            'cyan' => self::CYAN,
            'green' => self::GREEN,
            'yellow' => self::YELLOW,
            'orange' => self::ORANGE,
            'volcano' => self::VOLCANO,
            'grey' => self::GREY,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
