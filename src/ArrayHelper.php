<?php

namespace PascaleBeier\Config;

class ArrayHelper
{
    const DELIMITER = '.';

    public static function path($array, $path, $default = null)
    {
        if (! is_array($array)) {
            // This is not an array!
            return $default;
        }
     
        if (is_array($path)) {
            // The path has already been separated into keys
            $keys = $path;
        } else {
            if (array_key_exists($path, $array)) {
                // No need to do extra processing
                return $array[$path];
            }
     
            // Remove starting delimiters and spaces
            $path = ltrim($path, self::DELIMITER);
     
            // Remove ending delimiters, spaces, and wildcards
            $path = rtrim($path, self::DELIMITER);
     
            // Split the keys by delimiter
            $keys = explode(self::DELIMITER, $path);
        }
     
        do {
            $key = array_shift($keys);
     
            if (ctype_digit($key)) {
                // Make the key an integer
                $key = (int) $key;
            }
     
            if (isset($array[$key])) {
                if ($keys) {
                    if (is_array($array[$key])) {
                        // Dig down into the next part of the path
                        $array = $array[$key];
                    } else {
                        // Unable to dig deeper
                        break;
                    }
                } else {
                    // Found the path requested
                    return $array[$key];
                }
            }
        } while ($keys);
     
        // Unable to find the value requested
        return $default;
    }
}
