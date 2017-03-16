<?php

namespace PascaleBeier\Config;

class StringFormatter
{
    public static function format($string)
    {
        return explode('.', $string, 2);
    }
}
