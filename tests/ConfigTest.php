<?php

namespace PascaleBeier\Config;

use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @var Config
     */
    public $config;

    public function setUp()
    {
        $this->config = new Config(__DIR__.'/config/');
        $this->config->load();
    }

    public function testCanLoad()
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
        $expected = 'foo';
        $actual = $this->config->get('app.name');

        $this->assertEquals($expected, $actual);
    }

    public function testCanGetRecursive()
    {
        $expected = 'v2.0';
        $actual = $this->config->get('app.software.version');

        $this->assertEquals($expected, $actual);
    }

    public function testCanGetDefault()
    {
        $this->config->load();

        $expected = 'Karsten';
        $actual = $this->config->get('foo.baz', 'Karsten');

        $this->assertEquals($expected, $actual);
    }

    public function testHas()
    {
        $condition = $this->config->has('app.name');

        $this->assertTrue($condition);
    }
}
