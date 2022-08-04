<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PaymentMethodEnum extends Enum
{
    public const ATM = 0;
    public const INTERNATIONAL_CARD = 1;
    public const MOMO = 1;

    public static function getArrayView(): array
    {
        return [
            'Thẻ Nội Địa' => self::ATM,
            'Thẻ Quốc Tế' => self::INTERNATIONAL_CARD,
            'Momo' => self::MOMO,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
