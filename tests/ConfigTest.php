<?php

namespace PascaleBeier\Config;

use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @var Config
     */
    public $config;

    const EXISTING_PATH = 'app.software.version';
    const EXISTING_VALUE = 'v2.0';
    const NOT_EXISTING_PATH = 'foo.bar.baz.factory';
    const DEFAULT_VALUE = 'default';

    public function setUp()
    {
        $this->config = new Config(__DIR__.'/config/');
    }

    public function testCanConstruct()
    {
        $expected = [
            'app' => [
                'name' => 'foo',
                'software' => [
                    'version' => 'v2.0',
                ],
            ],
            'database' => [
                'host' => 'localhost',
            ],
        ];
        $actual = $this->config->getConfig();

        $this->assertEquals($expected, $actual);
    }

    public function testCanGet()
    {
        $this->assertEquals($this->config->get(self::EXISTING_PATH), self::EXISTING_VALUE);
    }

    public function testCanGetDefault()
    {
        $this->assertEquals(
            $this->config->get(self::NOT_EXISTING_PATH, self::DEFAULT_VALUE),
            self::DEFAULT_VALUE
        );
    }

    public function testGetShouldReturnNull()
    {
        $this->assertNull(
            $this->config->get(self::NOT_EXISTING_PATH)
        );
    }

    public function testHas()
    {
        $this->assertTrue($this->config->has(self::EXISTING_PATH));
    }

    public function testHasNot()
    {
        $this->assertFalse($this->config->has(self::NOT_EXISTING_PATH));
    }

    public function testCanGetAndSetDelimiter()
    {
        $this->config->setDelimiter('!');
        $this->assertEquals('!', $this->config->getDelimiter());
    }

    public function testCanGetWithChangedDelimiter()
    {
        $this->config->setDelimiter('!');
        $this->assertEquals(
            $this->config->get('app!software!version'),
            self::EXISTING_VALUE
        );
    }

    public function testCanGetWithFuzzyDelimiter()
    {
        $this->config->setDelimiter('->');
        $this->assertEquals(
            $this->config->get('app->software->version'),
            self::EXISTING_VALUE
        );
    }

    public function testCanGetWithWhitespaceDelimiter()
    {
        $this->config->setDelimiter(' -> ');
        $this->assertEquals(
            $this->config->get('app -> software -> version'),
            self::EXISTING_VALUE
        );
    }
}
