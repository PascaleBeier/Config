<?php

namespace PascaleBeier\Config;

use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    public function testCanFormatString()
    {
        $input = 'foo.bar';

        $expected = [
            'foo',
            'bar'
        ];

        $actual = StringFormatter::format($input);

        $this->assertEquals($expected, $actual);
    }
}
