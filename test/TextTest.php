<?php


use mapache_commons\Text;

class TextTest extends \PHPUnit\Framework\TestCase
{
	public function testBetween()
	{
		$this->assertEquals(' Brave ',Text::between('Hello Brave World','Hello','World'));
		$this->assertEquals(false,Text::between('Hello Brave World','hello','world'));
		$tmp=0;
		$this->assertEquals(' Brave ',Text::between('Hello Brave World','hello','world',$tmp,true));
		$tmp=13;
		$this->assertEquals(' Wayne ',Text::between('Hello Brave World, Hello Wayne World','Hello','World',$tmp));
		
	}

	public function testIsLower()
	{
		$this->assertEquals(true,Text::isLower('brave world'));
		$this->assertEquals(false,Text::isLower('Brave World'));
	}

	public function testIsUpper()
	{
		$this->assertEquals(false,Text::isUpper('brave world'));
		$this->assertEquals(false,Text::isUpper('Brave World'));
		$this->assertEquals(true,Text::isUpper('BRAVE WORLD'));
	}

	public function testReplaceBetween()
	{
		$this->assertEquals("Hello Wayne World",Text::replaceBetween('Hello Brave World','Hello','World',' Wayne '));
	}
}
