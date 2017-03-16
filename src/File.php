<?php

namespace PascaleBeier\Config;

use PascaleBeier\Config\Exception\FileNotFoundException;
use PascaleBeier\Config\Exception\NotAnArrayException;

class File
{
    public static function open($file)
    {
        if (!file_exists($file)) {
            throw new FileNotFoundException();
        }

        if (!is_array($array = include $file)) {
            throw new NotAnArrayException();
        }

        return $array;
    }
}
