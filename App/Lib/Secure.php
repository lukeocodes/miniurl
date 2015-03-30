<?php

namespace App\Lib;

class Secure
{

    public static function sanitizeArr($arr)
    {
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $arr[$key] = self::sanitizeArr($val);
            } elseif (is_string($val)) {
                $arr[$key] = self::sanitize($val);
            }
        }
        return $arr;
    }

    public static function sanitize($string)
    {
        return htmlspecialchars($string);
    }

}
