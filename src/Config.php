<?php

namespace PascaleBeier\Config;

class Config
{
    protected $path;

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    public function open($file)
    {
        return File::open($this->path . $file .'.php');
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        $formattedString = StringFormatter::format($key);
        $file = $this->open($formattedString[0]);

        return array_key_exists($formattedString[1], $file);
    }

    public function get($key, $default = null)
    {
        $formattedString = StringFormatter::format($key);
        $file = $this->open($formattedString[0]);

        $value = $default;

        if (isset($file[$formattedString[1]])) {
            $value = $file[$formattedString[1]];
        }

        return $value;
    }
}
