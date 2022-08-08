<?php

use Illuminate\Support\Str;

if(!function_exists('number_shorten')){
    function number_shorten($number, $precision = 3, $divisors = null) {

        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => 'K', // Thousand
                pow(1000, 2) => 'M', // Million
                pow(1000, 3) => 'B', // Billion
                pow(1000, 4) => 'T', // Trillion
                pow(1000, 5) => 'Qa', // Quadrillion
                pow(1000, 6) => 'Qi', // Quintillion
            );
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }

        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        return (int)number_format($number / $divisor, $precision) . $shorthand;
    }
}

if(!function_exists('add_hour')){
    function add_hour($time,$hour): string
    {

        $explodedTime = explode(':', $time );
        $sum = $explodedTime[0] + $hour;
        if($sum > 24){
            $sum -= 24;
        }

        return $sum . ':' . $explodedTime[1];
    }
}

if(!function_exists('encode_phone')){
    function encode_phone($phone): string
    {
        return substr($phone, 0, 3).'xxxx'.substr($phone, -3);
    }
}

if(!function_exists('encode_email')){
    function encode_email($mail): string
    {
        return substr($mail, 0, 3) . 'xxxxxxxxxxxx@' . Str::after($mail, '@');
    }
}
