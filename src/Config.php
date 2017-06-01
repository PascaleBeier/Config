<?php

namespace PascaleBeier\Config;

class Config implements ConfigInterface
{
    /** @var string */
    protected $delimiter = '.';

    /** @var array */
    protected $config = [];

    /** @inheritdoc */
    public function __construct($path)
    {
        foreach (new \FilesystemIterator($path) as $file) {
            if ($file->getExtension() === 'php') {
                $this->config[$file->getBasename('.php')] = include $file;
            }
        }
    }

    /** @inheritdoc */
    public function has($key)
    {
        return $this->get($key) !== null;
    }

    /** @inheritdoc */
    public function get($path, $default = null)
    {
        $array = $this->config;

        if (is_array($path)) {
            // The path has already been separated into keys
            $keys = $path;
        } else {
            if (array_key_exists($path, $array)) {
                // No need to do extra processing
                return $array[$path];
            }

            // Remove starting delimiters and spaces
            $path = ltrim($path, $this->delimiter);

            // Remove ending delimiters, spaces, and wildcards
            $path = rtrim($path, $this->delimiter);

            // Split the keys by delimiter
            $keys = explode($this->delimiter, $path);
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

    /** @inheritdoc */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /** @inheritdoc */
    public function getConfig()
    {
        return $this->config;
    }

    /** @inheritdoc */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /** @inheritdoc */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }
}
