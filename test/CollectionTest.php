<?php /** @noinspection PhpDeprecationInspection */

use mapache_commons\CollectionLib;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testXML(): void
    {
        $string='<?xml version="1.0" encoding="UTF-8" ?><root><item arg="1"><child>a</child></item><item arg="2"><child>b</child></item></root>';
        $xml=CollectionLib::stringToXML($string);
        $array=CollectionLib::xmlToArray($xml);
        $xmlBack=CollectionLib::arrayToXML($array,'root');
        $stringBack=CollectionLib::xmlToString($xmlBack,false);
        $this->assertInstanceOf('SimpleXMLElement',$xml);
        $this->assertEquals(['item'=>
            [
                ['@attributes'=>['arg'=>"1"],'child'=>'a'],
                ['@attributes'=>['arg'=>"2"],'child'=>'b'],
            ]],$array);
        $this->assertInstanceOf('SimpleXMLElement',$xmlBack);
        $this->assertEquals('<?xml version="1.0"?>'."\n".'<root><item arg="1"><child>a</child></item><item arg="2"><child>b</child></item></root>'."\n",$stringBack);
    }
    public function testGen1():void {
        $array=['Product'=>'cocacola','price'=>333,'quantity'=>22];
        $this->assertEquals('Product',CollectionLib::firstKey($array));
        $this->assertEquals(['product'=>'cocacola','price'=>333,'quantity'=>22],CollectionLib::arrayKeyLower($array));
        $this->assertEquals(['PRODUCT'=>'cocacola','PRICE'=>333,'QUANTITY'=>22],CollectionLib::arrayKeyUpper($array));
        $this->assertStringContainsString('<th>Product</th>',CollectionLib::generateTable($array));
    }
    public function testXML2(): void
    {
        $string='<?xml version="1.0" encoding="UTF-8" ?>
        <root>
            <item arg="1">a</item>
            <item arg="2">b</item>
        </root>';
        $xml=CollectionLib::stringToXML($string);
        $this->assertCount(2, $xml->item);
        $array=CollectionLib::xmlToArray($xml);
        $xmlBack=CollectionLib::arrayToXML($array,'root');
        $stringBack=CollectionLib::xmlToString($xmlBack,false);
        $this->assertInstanceOf('SimpleXMLElement',$xml);
        $this->assertEquals([
            'item' =>
                [
                    0 =>
                        [
                            '@attributes' =>
                                [
                                    'arg' => '1',
                                ],
                            '_value' => 'a',
                        ],
                    1 =>
                        [
                            '@attributes' =>
                                [
                                    'arg' => '2',
                                ],
                            '_value' => 'b',
                        ],
                ],
        ],$array);
        $this->assertInstanceOf('SimpleXMLElement',$xmlBack);
        $this->assertEquals('<?xml version="1.0"?>'."\n".'<root><item arg="1">a</item><item arg="2">b</item></root>'."\n",$stringBack);
    }
	public function testsplitOpeningClosing(): void
    {
        $this->assertEquals(['a','B-C-D','e','F-G-H']
            , CollectionLib::splitOpeningClosing("a(B-C-D)e(F-G-H)"));
		$this->assertEquals(['a','B,C,D','e','F,G,H']
			, CollectionLib::splitOpeningClosing("a(B,C,D)e(F,G,H)"));
        $this->assertEquals(['a','(B,C,D)','e','(F,G,H)']
            , CollectionLib::splitOpeningClosing("a(B,C,D)e(F,G,H)",'(',')',0,true,true));
		$this->assertEquals(['a','B,C,D','e','F,G,H','']
			, CollectionLib::splitOpeningClosing("a(B,C,D)e(F,G,H)"
											,'('
											,')'
											,0
											,false));
		$this->assertEquals(['a','B,C,D','e','F,G,H','i']
			, CollectionLib::splitOpeningClosing("a(B,C,D)e(F,G,H)i"));
		$this->assertEquals(['a','B,C,D','e','F,G<|,H','i,|>j,k']
			, CollectionLib::splitOpeningClosing("a<|B,C,D|>e<|F,G<|,H|>i,|>j,k"
											,"<|"
											,"|>"));
		$this->assertEquals(1
            ,CollectionLib::arraySearchField([['name'=>'john'],['name'=>'mary']],'name','mary'));
        $this->assertEquals(1
            ,CollectionLib::arraySearchField([(object)['name'=>'john'],(object)['name'=>'mary']],'name','mary'));
        $this->assertEquals([1,2]
            ,CollectionLib::arraySearchField([['name'=>'john'],['name'=>'mary'],['name'=>'mary']],'name','mary',true));
	}
	public function testsplitNotString(): void
    {
		$this->assertEquals(['a' , 'b' , 'CC,D,E' , 'e' , 'f']
			, CollectionLib::splitNotString('a,b,"CC,D,E",e,f',","));

		$this->assertEquals(['a' , 'b', 'CC D E' ,'', 'e' , 'f']
			, CollectionLib::splitNotString('a b "CC D E" e f'," ",0,false));
	}

	public function testisAssoc(): void
    {
	    $this->assertEquals(false,CollectionLib::isAssoc(['a','b']));
        $this->assertEquals(false,CollectionLib::isAssoc(['a','b'],true));
        $this->assertEquals(true,CollectionLib::isAssoc(['a'=>'a','b'=>'b']));
        $this->assertEquals(true,CollectionLib::isAssoc(['a'=>'a','b'=>'b'],true));
    }
    public function testarrayChangeKeyCaseRecursive(): void
    {
	    $arr=['A'=>'a','b'=>'b'];
	    $this->assertEquals(['a'=>'a','b'=>'b'],CollectionLib::arrayChangeKeyCaseRecursive($arr));
        $this->assertEquals(['A'=>'a','B'=>'b'],CollectionLib::arrayChangeKeyCaseRecursive($arr,CASE_UPPER));
    }

}
