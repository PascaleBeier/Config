<?php

namespace PascaleBeier\Config;

class Config
{
    /** @var string */
    protected $path;
    /** @var array */
    protected $config = [];

    public function __construct($path = __DIR__.'/config/')
    {
        $this->path = $path;
    }

    public function load()
    {
        foreach (new \FilesystemIterator($this->path) as $file) {
            if ($file->getExtension() === 'php') {
                $this->config[$file->getBasename('.php')] = include $file;
            }
        }
    }

    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return ArrayHelper::path($this->config, $key) !== null;
    }

    public function get($key, $default = null)
    {
        return ArrayHelper::path($this->config, $key, $default);
    }
}
