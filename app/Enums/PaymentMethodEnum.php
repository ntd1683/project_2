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
    public const MOMO = 2;
    public const OTHER = 3;

    public static function getArrayView(): array
    {
        return [
            'Thẻ Nội Địa' => self::ATM,
            'Thẻ Quốc Tế' => self::INTERNATIONAL_CARD,
            'Momo' => self::MOMO,
            'Khác'=>self::OTHER,
        ];
    }

    public static function getKeyByValue($value): string
    {
        if($value>2){
            $value = 3;
        }
        return array_search($value, self::getArrayView(), true);
    }
}
