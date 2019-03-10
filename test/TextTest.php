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
	public function testStripQuotes()
	{
		$this->assertEquals("brave world",Text::stripQuotes('brave world'));
		$this->assertEquals("brave world",Text::stripQuotes('"brave world"'));
		$this->assertEquals("\"brave world",Text::stripQuotes('"brave world'));
	}
	public function testIsUpper()
	{
		$this->assertEquals(false,Text::isUpper('brave world'));
		$this->assertEquals(false,Text::isUpper('Brave World'));
		$this->assertEquals(true,Text::isUpper('BRAVE WORLD'));
	}
	public function testgetArgument()
	{
		$this->assertEquals(['alpha','hello'],Text::getArgument('alpha=hello'));
		$this->assertEquals(['alpha','hello='],Text::getArgument('alpha=hello='));
		$this->assertEquals(['alpha',null],Text::getArgument('alpha'));
		$this->assertEquals([null,null],Text::getArgument(''));
		$this->assertEquals(['alpha','some value']
							,Text::getArgument('alpha:     some value   ',':'));
		$this->assertEquals(['alpha','  some value  ']
							,Text::getArgument('alpha:  some value  ',':',false));
		$this->assertEquals(['alpha','  some value  ']
			,Text::getArgument('alpha:  some value  ',':',false));		
	}
	public function teststrPosNotSpace() {
		// '   abc  def'
		// '01234567890'
		$this->assertEquals(3,Text::strPosNotSpace('   abc  def'));
		$this->assertEquals(3,Text::strPosNotSpace('   abc  def',2));
		$this->assertEquals(8,Text::strPosNotSpace('   abc  def',6));
		$this->assertEquals(0,Text::strPosNotSpace('abc'));
	}
	public function testReplaceBetween()
	{
		$this->assertEquals("Hello Wayne World",Text::replaceBetween('Hello Brave World','Hello','World',' Wayne '));
	}
}
