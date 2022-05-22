<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class UserLevelEnum extends Enum
{
    public const DRIVER = 0;
    public const STAFF = 1;
    public const ADMIN = 2;
}
