<?php /** @noinspection UnknownInspectionInspection */
/** @noinspection SqlNoDataSourceInspection */

/** @noinspection SqlDialectInspection */


use mapache_commons\TextLib;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
	public function testBetween(): void
    {
        $this->assertEquals('Hello ',TextLib::between('Hello Brave World','','Brave'));
        $this->assertEquals(' World',TextLib::between('Hello Brave World','Brave',''));
        $this->assertFalse(TextLib::between('Hello Brave World', 'Hello', 'xxx'));
        $this->assertFalse(TextLib::between('Hello Brave World', 'xxx', 'Hello'));
		$this->assertEquals(' Brave ',TextLib::between('Hello Brave World','Hello','World'));
		$this->assertFalse(TextLib::between('Hello Brave World', 'hello', 'world'));
		$tmp=0;
		$this->assertEquals(' Brave ',TextLib::between('Hello Brave World','hello','world',$tmp,true));
		$tmp=13;
		$this->assertEquals(' Wayne ',TextLib::between('Hello Brave World, Hello Wayne World','Hello','World',$tmp));

		$this->assertEquals('orld',TextLib::removeFirstChars('World'));
        $this->assertEquals('Worl',TextLib::removeLastChars('World'));

        $this->assertEquals('(world)',TextLib::addParenthesis('world'));
        $this->assertEquals('(world)',TextLib::addParenthesis('(world)'));
        $this->assertEquals('"(world)"',TextLib::addParenthesis('(world)','"','"'));
        $this->assertTrue(TextLib::hasParenthesis('(world)'));
	}

	public function testIsLower(): void
    {
		$this->assertTrue(TextLib::isLower('brave world'));
		$this->assertFalse(TextLib::isLower('Brave World'));
	}
	public function testStripQuotes(): void
    {
		$this->assertEquals("brave world",TextLib::stripQuotes('brave world'));
		$this->assertEquals("brave world",TextLib::stripQuotes('"brave world"'));
		$this->assertEquals("\"brave world",TextLib::stripQuotes('"brave world'));
	}
	public function testIsUpper(): void
    {
		$this->assertFalse(TextLib::isUpper('brave world'));
		$this->assertFalse(TextLib::isUpper('Brave World'));
		$this->assertTrue(TextLib::isUpper('BRAVE WORLD'));
	}
	public function testgetArgument(): void
    {
		$this->assertEquals(['alpha','hello'],TextLib::getArgument('alpha=hello'));
		$this->assertEquals(['alpha','hello='],TextLib::getArgument('alpha=hello='));
		$this->assertEquals(['alpha',null],TextLib::getArgument('alpha'));
		$this->assertEquals([null,null],TextLib::getArgument(''));
		$this->assertEquals(['alpha','some value']
							,TextLib::getArgument('alpha:     some value   ',':'));
		$this->assertEquals(['alpha','  some value  ']
							,TextLib::getArgument('alpha:  some value  ',':',false));
		$this->assertEquals(['alpha','  some value  ']
			,TextLib::getArgument('alpha:  some value  ',':',false));
	}
	public function teststrPosNotSpace(): void
    {
		// '   abc  def'
		// '01234567890'
		$this->assertEquals(3,TextLib::strPosNotSpace('   abc  def'));
		$this->assertEquals(3,TextLib::strPosNotSpace('   abc  def',2));
		$this->assertEquals(8,TextLib::strPosNotSpace('   abc  def',6));
		$this->assertEquals(0,TextLib::strPosNotSpace('abc'));
        $this->assertEquals(2,TextLib::strPosNotSpace(" \nabc"));
        $this->assertEquals(1,TextLib::strPosNotSpace(" \nabc",0," "));
	}
	public function testWildCard(): void
    {
        $this->assertEquals('def_abc',TextLib::str_replace_ex('abc','','abcdef_abc',1));
        $this->assertTrue(TextLib::wildCardComparison('abcdef', '*'));
        $this->assertTrue(TextLib::wildCardComparison('abcdef', 'a*'));
	    $this->assertTrue(TextLib::wildCardComparison('abcdef', 'abc*'));
        $this->assertTrue(TextLib::wildCardComparison('abcdef', '*def'));
        $this->assertTrue(TextLib::wildCardComparison('abcdef', '*abc*'));
        $this->assertFalse(TextLib::wildCardComparison('abcdef', '1abc*'));
        $this->assertFalse(TextLib::wildCardComparison('abcdef', '*1def'));
        $this->assertFalse(TextLib::wildCardComparison('abcdef', '*1abc*'));
    }
	public function testReplaceBetween(): void
    {
		$this->assertEquals("Hello Wayne World",TextLib::replaceBetween('Hello Brave World','Hello','World',' Wayne '));
		$off=0;
        $this->assertEquals("world",TextLib::replaceBetween('(hello)','(',')','world',$off,true));
        $off=0;
        $this->assertEquals("hi:world",TextLib::replaceBetween('hi:(hello)','(',')','world',$off,true));
        $off=0;
        $this->assertEquals("ABCDworldABCD",TextLib::replaceBetween('ABCD(hello)ABCD','(',')','world',$off,true));
        $off=0;
        $this->assertEquals("ABCD1234567890ABCD",TextLib::replaceBetween('ABCD(123)ABCD','(',')','1234567890',$off,true));
        $off=0;
        $this->assertEquals("ABCD123ABCD",TextLib::replaceBetween('ABCD(1234567890)ABCD','(',')','123',$off,true));
        $off=0;
        $this->assertEquals("ABCD123ABCD",TextLib::replaceBetween('ABCD(((1234567890)))ABCD','(((',')))','123',$off,true));
	}

    public function testparseArg(): void
    {
        $this->assertEquals(['a'=>'1','b'=>'2'],TextLib::parseArg('a=1,b=2'));
        $this->assertEquals(['a'=>'1','b'=>'2'],TextLib::parseArg('a=1&b=2','&'));
        $txt="a1=1,a2=2,a3='a1,bb'";
        $this->assertEquals([
                                'a1'=>'1'
                                ,'a2'=>'2'
                                ,'a3'=>"'a1"
                                ,"bb'"=>''],TextLib::parseArg($txt));
        $this->assertEquals(['a1'=>'1','a2'=>'2','a3'=>"'a1,bb'"],TextLib::parseArg2($txt));
    }
    public function testReplaceCurlyVariable(): void
    {
	    $this->assertEquals('hello=world',TextLib::replaceCurlyVariable('hello={{var}}',['var'=>'world']));
        $this->assertEquals('hello=world hello2=world2',TextLib::replaceCurlyVariable('hello={{var}} hello2={{var2}}',['var'=>'world','var2'=>'world2']));
        $this->assertEquals('hello=world hello2=world2 hello3=',TextLib::replaceCurlyVariable('hello={{var}} hello2={{var2}} hello3={{varxx}}',['var'=>'world','var2'=>'world2']));
        $this->assertEquals('hello=world hello2=world2 hello3={{varxx}}'
            ,TextLib::replaceCurlyVariable('hello={{var}} hello2={{var2}} hello3={{varxx}}'
                ,['var'=>'world','var2'=>'world2'],true));
    }
    public function testnaturalArg(): void
    {
	    $this->assertEquals(['select'=>'*','from'=>'table','where'=>'1=1']
        ,TextLib::naturalArg('select * from table where 1=1'
                ,['select'=>'req','from'=>'req','where'=>'opt']));

        $this->assertEquals(Array ('item' => 'item', 'export' => 'table', 'inport' => 'file')
            ,TextLib::naturalArg('item export table inport file'
                ,['item'=>'first','export'=>'opt','inport'=>'opt']));
    }
    public function testisCamelCase(): void
    {
        $this->assertEquals("helloWorld",TextLib::camelCase('HelloWorld'));

        $this->assertEquals("helloWorld",TextLib::camelCase('hello_world'));

        $txt='object= ';

        $this->assertEquals("object= ",TextLib::camelCase($txt));

    }
    public function testremoveParenthesis(): void
    {
        $this->assertEquals('hello',TextLib::removeParenthesis('hello'));
        $this->assertEquals('hello',TextLib::removeParenthesis('(hello)'));
        $this->assertEquals('hello',TextLib::removeParenthesis('[hello]',['(','{','['],[')','}',']']));
    }

    public function teststrposArray(): void
    {
	    //                                       01234567890
        $this->assertEquals(3,TextLib::strposArray('a,b.d.e,f.g',['x','t','.']));
        //                                        01234567890
        $this->assertEquals(7,TextLib::strposArray('a,b.d.e,f.g',['x','t',','],0,true));
    }

}
