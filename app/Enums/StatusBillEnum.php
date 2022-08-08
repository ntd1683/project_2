<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusBillEnum extends Enum
{
    public const UNPAID = 0;
    public const PAID = 1;

    public static function getArrayView(): array
    {
        return [
            'Chưa thanh toán' => self::UNPAID,
            'Đã thanh toán' => self::PAID,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
