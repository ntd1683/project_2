<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class UserLevelEnum extends Enum
{
    public const DRIVER = 0;
    public const STAFF = 1;
    public const ADMIN = 2;

    public static function getArrayView():array
    {
        return [
            'Bác Tài' => self::DRIVER,
            'Nhân Viên' => self::STAFF,
            'Quản Lý' => self::ADMIN,
        ];
    }

    public static function getKeyByValue($value):string
    {
        return array_search($value,self::getArrayView(),true);
    }
}
