<?php

use mapache_commons\FileLib;
use PHPUnit\Framework\TestCase;

class FilesTest extends TestCase
{
    public function testFiles(): void
    {
        $dir=__DIR__; // str_replace("\\","/",__DIR__);
        $contents=FileLib::getDirFiles($dir.'/testfile');
        $this->assertEquals([
            FileLib::fixUrlSeparator($dir.'/testfile/file3.txt'),
            FileLib::fixUrlSeparator($dir.'/testfile/file4.doc'),
            FileLib::fixUrlSeparator($dir.'/testfile/one/file2.txt'),
            FileLib::fixUrlSeparator($dir.'/testfile/one/two/file1.txt'),
        ],$contents);
        $content2=FileLib::getDirFirstFile($dir.'/testfile',['doc','txt']);
        $this->assertEquals(
            FileLib::fixUrlSeparator($dir.'/testfile/file4.doc'),$content2);
        $folders=FileLib::getDirFolders($dir.'/testfile');
        $this->assertEquals([
            FileLib::fixUrlSeparator($dir.'/testfile/one'),
            FileLib::fixUrlSeparator($dir.'/testfile/one/two'),
        ],$folders);
        $contents=FileLib::getDirFiles($dir.'/testfile',['doc']);
        $this->assertEquals([
            FileLib::fixUrlSeparator($dir.'/testfile/file4.doc'),
        ],$contents);
    }
    public function testFile2(): void
    {
        $this->assertEquals("hello",FileLib::safeFileGetContent(__DIR__."/testfile/file3.txt"));
        $this->assertEquals(null,FileLib::safeFileGetContent(__DIR__."/testfile/file3x.txt"));
        $this->assertTrue(FileLib::safeFilePutContent(__DIR__ . "/testfile/file3.txt", 'hello'));
    }
    public function testFile3(): void
    {
        $this->assertEquals('ext',FileLib::getExtensionPath('/dir/dir1/file1.ext'));
        $this->assertEquals('/dir/dir1',FileLib::getDirPath('/dir/dir1/file1.txt'));
        $this->assertEquals('file1.txt',FileLib::getBaseNamePath('/dir/dir1/file1.txt'));
        $this->assertEquals('file1',FileLib::getFileNamePath('/dir/dir1/file1.txt'));
        if(PHP_OS_FAMILY==='Windows') {
            $this->assertTrue(FileLib::isAbsolutePath('c:\\temp1\\temp2.txt'));
            $this->assertFalse(FileLib::isAbsolutePath('temp1\\temp2.txt'));
        } else {
            $this->assertFalse(FileLib::isAbsolutePath('/temp1/temp2.txt'));
            $this->assertTrue(FileLib::isAbsolutePath('temp1/temp2.txt'));
        }
    }
}