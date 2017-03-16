<?php

namespace PascaleBeier\Config;

use PascaleBeier\Config\Exception\FileNotFoundException;
use PascaleBeier\Config\Exception\NotAnArrayException;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{

    public function setUp()
    {
        if (file_exists('foo.php')) {
            unlink('foo.php');
        }
    }

    public function testThrowsFileNotFoundException()
    {
        $this->expectException(FileNotFoundException::class);

        File::open('foo.php');
    }

    public function testThrowsNotAnArrayException()
    {
        $this->expectException(NotAnArrayException::class);

        touch('foo.php');

        File::open('foo.php');
    }

    public function testOpen()
    {
        touch('foo.php');
        file_put_contents('foo.php', '<?php return [];');

        $expected = [];

        $actual = File::open('foo.php');

        $this->assertEquals($expected, $actual);
    }

    public function tearDown()
    {
        if (file_exists('foo.php')) {
            unlink('foo.php');
        }
    }
}
