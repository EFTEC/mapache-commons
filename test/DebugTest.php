<?php

use mapache_commons\Debug;
use PHPUnit\Framework\TestCase;

class DebugTest extends TestCase
{
	var $logFile=__DIR__."/scratch/log.log";
	/**
	 * DebugTest constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		@unlink($this->logFile);
	}

	public function testWriteLog()
	{
		$this->assertEquals(true,Debug::WriteLog($this->logFile,"error","Hello Brave World"));
		$this->assertEquals(true,file_exists($this->logFile));
	}

	public function testVar_dump()
	{
		$this->assertEquals('<script>console.log(["a","b"]);</script>',Debug::var_dump(['a','b'],1,true));
		$this->assertEquals("<pre>Array\n(\n    [0] => a\n    [1] => b\n)\n</pre>",Debug::var_dump(['a','b'],2,true));
	}
}
