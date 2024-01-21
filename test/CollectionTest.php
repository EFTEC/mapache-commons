<?php


use mapache_commons\Collection;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testXML(): void
    {
        $string='<?xml version="1.0" encoding="UTF-8" ?><root><item arg="1"><child>a</child></item><item arg="2"><child>b</child></item></root>';
        $xml=Collection::stringToXML($string);
        $array=Collection::xmlToArray($xml);
        $xmlBack=Collection::arrayToXML($array,'root');
        $stringBack=Collection::xmlToString($xmlBack,false);
        $this->assertInstanceOf('SimpleXMLElement',$xml);
        $this->assertEquals(['item'=>
            [
                ['@attributes'=>['arg'=>"1"],'child'=>'a'],
                ['@attributes'=>['arg'=>"2"],'child'=>'b'],
            ]],$array);
        $this->assertInstanceOf('SimpleXMLElement',$xmlBack);
        $this->assertEquals('<?xml version="1.0"?>'."\n".'<root><item arg="1"><child>a</child></item><item arg="2"><child>b</child></item></root>'."\n",$stringBack);
    }
    public function testXML2(): void
    {
        $string='<?xml version="1.0" encoding="UTF-8" ?>
        <root>
            <item arg="1">a</item>
            <item arg="2">b</item>
        </root>';
        $xml=Collection::stringToXML($string);
        $this->assertCount(2, $xml->item);
        $array=Collection::xmlToArray($xml);
        $xmlBack=Collection::arrayToXML($array,'root');
        $stringBack=Collection::xmlToString($xmlBack,false);
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
	public function testsplitOpeningClosing()
	{
        $this->assertEquals(['a','B-C-D','e','F-G-H']
            , Collection::splitOpeningClosing("a(B-C-D)e(F-G-H)"));
		$this->assertEquals(['a','B,C,D','e','F,G,H']
			, Collection::splitOpeningClosing("a(B,C,D)e(F,G,H)"));
        $this->assertEquals(['a','(B,C,D)','e','(F,G,H)']
            , Collection::splitOpeningClosing("a(B,C,D)e(F,G,H)",'(',')',0,true,true));
		$this->assertEquals(['a','B,C,D','e','F,G,H','']
			, Collection::splitOpeningClosing("a(B,C,D)e(F,G,H)"
											,'('
											,')'
											,0
											,false));
		$this->assertEquals(['a','B,C,D','e','F,G,H','i']
			, Collection::splitOpeningClosing("a(B,C,D)e(F,G,H)i"));
		$this->assertEquals(['a','B,C,D','e','F,G<|,H','i,|>j,k']
			, Collection::splitOpeningClosing("a<|B,C,D|>e<|F,G<|,H|>i,|>j,k"
											,"<|"
											,"|>"));
		$this->assertEquals(1
            ,Collection::arraySearchField([['name'=>'john'],['name'=>'mary']],'name','mary'));
        $this->assertEquals(1
            ,Collection::arraySearchField([(object)['name'=>'john'],(object)['name'=>'mary']],'name','mary'));
        $this->assertEquals([1,2]
            ,Collection::arraySearchField([['name'=>'john'],['name'=>'mary'],['name'=>'mary']],'name','mary',true));
	}
	public function testsplitNotString()
	{
		$this->assertEquals(['a' , 'b' , 'CC,D,E' , 'e' , 'f']
			, Collection::splitNotString('a,b,"CC,D,E",e,f',","));

		$this->assertEquals(['a' , 'b', 'CC D E' ,'', 'e' , 'f']
			, Collection::splitNotString('a b "CC D E" e f'," ",0,false));
	}

	public function testisAssoc() {
	    $this->assertEquals(false,Collection::isAssoc(['a','b']));
        $this->assertEquals(true,Collection::isAssoc(['a'=>'a','b'=>'b']));
    }
    public function testarrayChangeKeyCaseRecursive() {
	    $arr=['A'=>'a','b'=>'b'];
	    $this->assertEquals(['a'=>'a','b'=>'b'],Collection::arrayChangeKeyCaseRecursive($arr));
        $this->assertEquals(['A'=>'a','B'=>'b'],Collection::arrayChangeKeyCaseRecursive($arr,CASE_UPPER));
    }

}
