<?php

namespace PascaleBeier\Config;

interface ConfigInterface
{

    
    /**
     * Sets the Config Path to be used for
     * loading the configuration files into memory.
     *
     * @param string $path path to the config directory, e.g. __DIR__.'/../config/'
     */
    public function __construct($path);

    /**
     * Get a value by its key while the key is
     * a given string path delimited by '.'.
     * A string might look like foo.bar.baz
     * which would look for ['foo']['bar']['baz'].
     *
     * @param  string $key    will be sought after
     * @param  mixed $default will be returned if key is absent
     * @return mixed          the key's value or $default
     */
    public function get($key, $default = null);

    /**
     * See get(). Check if a given string path
     * can be found - if not, return false.
     *
     * @param  string $key will be sought after
     * @return boolean     true if found, false otherwise
     */
    public function has($key);

    /**
     * Load all .php files in the given path
     * (see __construct()) to memory.
     *
     * @return void
     */
    public function load();
}
