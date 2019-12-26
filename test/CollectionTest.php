<?php


use mapache_commons\Collection;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
	public function testsplitOpeningClosing()
	{
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
