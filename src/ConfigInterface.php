<?php

namespace PascaleBeier\Config;

interface ConfigInterface
{
    /**
     * Load all .php files in the given path into memory.
     *
     * @param string $path path to the config directory, e.g. __DIR__.'/../config/'
     */
    public function __construct(string $path);

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
    public function get(string $key, $default = null);

    /**
     * See get(). Check if a given string path
     * can be found - if not, return false.
     *
     * @param  string $key will be sought after
     * @return boolean     true if found, false otherwise
     */
    public function has(string $key);

    /**
     * Defines the delimiter to be used, defaults to '.'.
     * This way, you could use any delimiter, for instance ':'.
     * You would get('foo:bar:baz') then.
     *
     * @param $delimiter
     * @return mixed
     */
    public function setDelimiter(string $delimiter);

    /**
     * Returns the delimiter.
     *
     * @return string
     */
    public function getDelimiter(): string;

    /**
     * Overrides the Config array.
     *
     * @param array $config
     * @return void
     */
    public function setConfig(array $config);

    /**
     * Returns the config array.
     *
     * @return array
     */
    public function getConfig(): array;
}
