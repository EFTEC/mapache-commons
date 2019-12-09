<?php /** @noinspection SqlNoDataSourceInspection */

/** @noinspection SqlDialectInspection */

use mapache_commons\Text;

class TextTest extends \PHPUnit\Framework\TestCase
{
	public function testBetween()
	{
        $this->assertEquals('Hello ',Text::between('Hello Brave World','','Brave'));
        $this->assertEquals(' World',Text::between('Hello Brave World','Brave',''));
        $this->assertEquals(false,Text::between('Hello Brave World','Hello','xxx'));
        $this->assertEquals(false,Text::between('Hello Brave World','xxx','Hello'));
		$this->assertEquals(' Brave ',Text::between('Hello Brave World','Hello','World'));
		$this->assertEquals(false,Text::between('Hello Brave World','hello','world'));
		$tmp=0;
		$this->assertEquals(' Brave ',Text::between('Hello Brave World','hello','world',$tmp,true));
		$tmp=13;
		$this->assertEquals(' Wayne ',Text::between('Hello Brave World, Hello Wayne World','Hello','World',$tmp));
		
		$this->assertEquals('orld',Text::removeFirstChars('World',1));
        $this->assertEquals('Worl',Text::removeLastChars('World',1));
        
        $this->assertEquals('(world)',Text::addParenthesis('world'));
        $this->assertEquals('(world)',Text::addParenthesis('(world)'));
        $this->assertEquals('"(world)"',Text::addParenthesis('(world)','"','"'));
        $this->assertEquals(true,Text::hasParenthesis('(world)'));
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
		$off=0;
        $this->assertEquals("world",Text::replaceBetween('(hello)','(',')','world',$off,true));
        $off=0;
        $this->assertEquals("hi:world",Text::replaceBetween('hi:(hello)','(',')','world',$off,true));
	}

    public function testparseArg() {
        $this->assertEquals(['a'=>'1','b'=>'2'],Text::parseArg('a=1,b=2'));
        $this->assertEquals(['a'=>'1','b'=>'2'],Text::parseArg('a=1&b=2','&'));
    }
    public function testnaturalArg() {
	    $this->assertEquals(['select'=>'*','from'=>'table','where'=>'1=1']
        ,Text::naturalArg('select * from table where 1=1'
                ,['select'=>'req','from'=>'req','where'=>'opt']));

        $this->assertEquals(Array ('item' => 'item', 'export' => 'table', 'inport' => 'file')
            ,Text::naturalArg('item export table inport file'
                ,['item'=>'first','export'=>'opt','inport'=>'opt']));
    }
    public function testisCamelCase() {
        $this->assertEquals("helloWorld",Text::camelCase('HelloWorld'));
        $this->assertEquals("helloWorld",Text::camelCase('hello_world'));
        
    }
    public function testremoveParenthesis() {
        $this->assertEquals('hello',Text::removeParenthesis('hello'));
        $this->assertEquals('hello',Text::removeParenthesis('(hello)'));
        $this->assertEquals('hello',Text::removeParenthesis('[hello]',['(','{','['],[')','}',']']));
    }

    public function teststrposArray() {
	    //                                       01234567890
        $this->assertEquals(3,Text::strposArray('a,b.d.e,f.g',['x','t','.']));
        //                                        01234567890
        $this->assertEquals(7,Text::strposArray('a,b.d.e,f.g',['x','t',','],0,true));
    }
    
}
