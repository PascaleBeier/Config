<?php

namespace PascaleBeier\Config;

use PHPUnit\Framework\TestCase;

class ArrayHelperTest extends TestCase
{
	protected $config;

	public function setUp()
	{
		$this->config = new Config(__DIR__.'/config/');
        $this->config->load();
	}

	public function testPathReturnsValue()
	{
		$this->assertEquals(
			ArrayHelper::path($this->config->getConfig(), 'app.software.version'), 
			'v2.0'
		);
	}

	public function testPathShouldReturnNull()
	{
		$this->assertNull(
			ArrayHelper::path($this->config->getConfig(), 'abstract.bar.baz.factory')
		);
	}
}