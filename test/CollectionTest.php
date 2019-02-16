<?php

use mapache_commons\Collection;

class CollectionTest extends \PHPUnit\Framework\TestCase
{
	var $drinks=['CocaCola'=>200,'Fanta'=>300,'Sprite'=>500,'Inka Cola'=>999];
	var $drinksNoAssoc=['CocaCola','Fanta','Sprite','Inka Cola'];
	
	

	public function testFirst()
	{
		$this->assertEquals('200',Collection::first($this->drinks));
	}

	public function testArrayKeyLower()
	{
		$this->assertEquals(['cocacola'=>200,'fanta'=>300,'sprite'=>500,'inka cola'=>999]
			,Collection::arrayKeyLower($this->drinks));
	}

	public function testFirstKey()
	{
		$this->assertEquals('CocaCola',Collection::firstKey($this->drinks));
	}

	public function testIsAssoc()
	{
		$this->assertEquals(true,Collection::isAssoc($this->drinks));
		$this->assertEquals(false,Collection::isAssoc($this->drinksNoAssoc));
	}

	public function testArrayKeyUpper()
	{
		$this->assertEquals(['COCACOLA'=>200,'FANTA'=>300,'SPRITE'=>500,'INKA COLA'=>999]
			,Collection::arrayKeyUpper($this->drinks));
	}

	public function testGenerateTable()
	{
		$this->assertTrue(Collection::generateTable(['c1'=>1,'c2'=>2])!="");
	}
}
