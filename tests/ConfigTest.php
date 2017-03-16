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
        $this->config = new Config();

        touch('foo.php');
        file_put_contents('foo.php', '<?php return [\'bar\' => \'baz\'];');
    }

    public function testCanSetAndGetPath()
    {
        $expected = 'foo';
        $this->config->setPath('foo');

        $this->assertEquals($expected, $this->config->getPath());
    }

    public function testCanOpen()
    {
        $expected = ['bar' => 'baz'];
        $actual = $this->config->open('foo');

        $this->assertEquals($expected, $actual);
    }

    public function testCanGet()
    {
        $expected = 'baz';
        $actual = $this->config->get('foo.bar');

        $this->assertEquals($expected, $actual);
    }

    public function testCanGetDefault()
    {
        $expected = 'Karsten';
        $actual = $this->config->get('foo.baz', 'Karsten');

        $this->assertEquals($expected, $actual);
    }

    public function testHas()
    {
        $condition = $this->config->has('foo.bar');

        $this->assertTrue($condition);
    }

    public function tearDown()
    {
        if (file_exists('foo.php')) {
            unlink('foo.php');
        }
    }
}
