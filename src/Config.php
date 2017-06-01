<?php

namespace PascaleBeier\Config;

class Config implements ConfigInterface
{
    /** @var string */
    protected $path;
    /** @var array */
    protected $config = [];

    /** @inheritdoc */
    public function __construct($path = __DIR__.'/config/')
    {
        $this->path = $path;
    }

    /** @inheritdoc */
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

    /** @inheritdoc */
    public function has($key)
    {
        return ArrayHelper::path($this->config, $key) !== null;
    }
    
    /** @inheritdoc */
    public function get($key, $default = null)
    {
        return ArrayHelper::path($this->config, $key, $default);
    }
}
