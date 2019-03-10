<?php


use mapache_commons\Collection;
use mapache_commons\Text;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
	public function testsplitOpeningClosing()
	{
		$this->assertEquals(['a','B,C,D','e','F,G,H']
			, Collection::splitOpeningClosing("a(B,C,D)e(F,G,H)"));
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
	}
	public function testsplitNotString()
	{
		$this->assertEquals(['a' , 'b' , 'CC,D,E' , 'e' , 'f']
			, Collection::splitNotString('a,b,"CC,D,E",e,f',","));
		$this->assertEquals(['a' , 'b', 'CC D E' ,'', 'e' , 'f']
			, Collection::splitNotString('a b "CC D E" e f'," ",0,false));		
	}	
}
