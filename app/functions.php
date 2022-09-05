<?php

use Illuminate\Support\Str;
//input : 188833 => output = 189k
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
// chuyển giờ
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
//mã hoá số điện thoại
if(!function_exists('encode_phone')){
    function encode_phone($phone): string
    {
        return substr($phone, 0, 3).'xxxx'.substr($phone, -3);
    }
}
//mã hoá email
if(!function_exists('encode_email')){
    function encode_email($mail): string
    {
        return substr($mail, 0, 3) . 'xxxxxxxxxxxx@' . Str::after($mail, '@');
    }
}
//unique
if(!function_exists('unique_multidim_array')){

    function unique_multidim_array($array, $key): array
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
}
if(!function_exists('hour_to_day')){
    function hour_to_day($hour): string
    {
        if($hour<=24){
            return $hour . 'Giờ';
        }
        (int)$date = floor($hour/24);
        $new_hour = $hour - $date*24;
        return $date .' Ngày '.$new_hour .' giờ';
    }
}
