# Mapache Commons
It's a set of useful functions for PHP. The name is a pun (Mapache in spanish is "raccoon")

[![Packagist](https://img.shields.io/packagist/v/eftec/mapache-commons.svg)](https://packagist.org/packages/eftec/mapache-commons)
[![Maintenance](https://img.shields.io/maintenance/yes/2026.svg)]()
[![composer](https://img.shields.io/badge/composer-%3E2.0-blue.svg)]()
[![php](https://img.shields.io/badge/php-7.4-green.svg)]()
[![php](https://img.shields.io/badge/php-8.4-green.svg)]()
[![CocoaPods](https://img.shields.io/badge/docs-70%25-yellow.svg)]()

<!-- TOC -->
* [Mapache Commons](#mapache-commons)
  * [Goals](#goals)
  * [Families](#families)
  * [CollectionLib](#collectionlib)
    * [Method isAssoc()](#method-isassoc)
      * [Parameters:](#parameters)
    * [Method first()](#method-first)
      * [Parameters:](#parameters-1)
    * [Method firstKey()](#method-firstkey)
      * [Parameters:](#parameters-2)
    * [Method arrayKeyLower()](#method-arraykeylower)
      * [Parameters:](#parameters-3)
    * [Method arrayKeyUpper()](#method-arraykeyupper)
      * [Parameters:](#parameters-4)
    * [Method generateTable()](#method-generatetable)
      * [Parameters:](#parameters-5)
    * [Method splitOpeningClosing()](#method-splitopeningclosing)
      * [Parameters:](#parameters-6)
    * [Method splitNotString()](#method-splitnotstring)
      * [Parameters:](#parameters-7)
    * [Method arrayChangeKeyCaseRecursive()](#method-arraychangekeycaserecursive)
      * [Parameters:](#parameters-8)
    * [Method arraySearchField()](#method-arraysearchfield)
      * [Parameters:](#parameters-9)
    * [Method xmlToString()](#method-xmltostring)
      * [Parameters:](#parameters-10)
    * [Method arrayToXML()](#method-arraytoxml)
      * [Parameters:](#parameters-11)
    * [Method stringToXML()](#method-stringtoxml)
      * [Parameters:](#parameters-12)
    * [Method xmlToArray()](#method-xmltoarray)
      * [Parameters:](#parameters-13)
  * [DebugLib](#debuglib)
    * [Method var_dump()](#method-var_dump)
      * [Parameters:](#parameters-14)
    * [Method WriteLog()](#method-writelog)
      * [Parameters:](#parameters-15)
  * [TextLib](#textlib)
    * [Method isUpper()](#method-isupper)
      * [Parameters:](#parameters-16)
    * [Method isLower()](#method-islower)
      * [Parameters:](#parameters-17)
    * [Method between()](#method-between)
      * [Parameters:](#parameters-18)
    * [Method stripQuotes()](#method-stripquotes)
      * [Parameters:](#parameters-19)
    * [Method removeParenthesis()](#method-removeparenthesis)
      * [Parameters:](#parameters-20)
    * [Method replaceBetween()](#method-replacebetween)
      * [Parameters:](#parameters-21)
    * [Method removeFirstChars()](#method-removefirstchars)
      * [Parameters:](#parameters-22)
    * [Method removeLastChars()](#method-removelastchars)
      * [Parameters:](#parameters-23)
    * [Method getArgument()](#method-getargument)
      * [Parameters:](#parameters-24)
    * [Method strPosNotSpace()](#method-strposnotspace)
      * [Parameters:](#parameters-25)
    * [Method strposArray()](#method-strposarray)
      * [Parameters:](#parameters-26)
    * [Method parseArg()](#method-parsearg)
      * [Parameters:](#parameters-27)
    * [Method parseArg2()](#method-parsearg2)
      * [Parameters:](#parameters-28)
    * [Method naturalArg()](#method-naturalarg)
      * [Parameters:](#parameters-29)
    * [Method str_replace_ex()](#method-str_replace_ex)
      * [Parameters:](#parameters-30)
    * [Method wildCardComparison()](#method-wildcardcomparison)
      * [Parameters:](#parameters-31)
    * [Method endsWith()](#method-endswith)
      * [Parameters:](#parameters-32)
    * [Method replaceCurlyVariable()](#method-replacecurlyvariable)
      * [Parameters:](#parameters-33)
    * [Method addParenthesis()](#method-addparenthesis)
      * [Parameters:](#parameters-34)
    * [Method hasParenthesis()](#method-hasparenthesis)
      * [Parameters:](#parameters-35)
    * [Method camelCase()](#method-camelcase)
      * [Parameters:](#parameters-36)
  * [FileLib](#filelib)
    * [Field lastError ()](#field-lasterror-)
    * [Method getDirFiles()](#method-getdirfiles)
      * [Parameters:](#parameters-37)
    * [Method getDirFirstFile()](#method-getdirfirstfile)
      * [Parameters:](#parameters-38)
    * [Method getDirFolders()](#method-getdirfolders)
      * [Parameters:](#parameters-39)
    * [Method getExtensionPath()](#method-getextensionpath)
      * [Parameters:](#parameters-40)
    * [Method getFileNamePath()](#method-getfilenamepath)
      * [Parameters:](#parameters-41)
    * [Method getBaseNamePath()](#method-getbasenamepath)
      * [Parameters:](#parameters-42)
    * [Method getDirPath()](#method-getdirpath)
      * [Parameters:](#parameters-43)
    * [Method fixUrlSeparator()](#method-fixurlseparator)
      * [Parameters:](#parameters-44)
    * [Method safeFileGetContent()](#method-safefilegetcontent)
      * [Parameters:](#parameters-45)
    * [Method safeFilePutContent()](#method-safefileputcontent)
      * [Parameters:](#parameters-46)
    * [Method isAbsolutePath()](#method-isabsolutepath)
      * [Parameters:](#parameters-47)
  * [Version list](#version-list)
  * [License](#license)
<!-- TOC -->



![Mapache Commons](docs/raccoon_small.png)  
__Mapache Commons__

## Goals

It's a set of useful function with the next requirements:
* The function mustn't have dependencies (unless it requires a php module).  
* The function must be FAST and memory friendly over the syntax sugar.
* The function must be able to run statically, and it must be self-contained.
* The function must be generic, and it must solve generic problems.  For example, a function that calculates the VAT of a specific country is not allowed.  

## Families
* CollectionLib
* TextLib
* DebugLib

## CollectionLib
Class CollectionLib

### Method isAssoc()
Returns true if array is an associative array, false is it's an indexed array<br>
**Example:**
```
$isAssoc=CollectionLib::isAssoc($array); // slow, more precise.
$isAssoc=CollectionLib::isAssoc($array,true); // fast, less precise
```
#### Parameters:
* **$array** input array (array)

### Method first()
Returns the first element of an array.<br>
Sometimes the first element is not the index [0], for example ['key1'=>1,0=2] where the first element is 'key1' and not 0.
This function always returns the right value.
#### Parameters:
* **$array** input array (array)

### Method firstKey()
Returns the first key of an array.
#### Parameters:
* **$array** input array (array)

### Method arrayKeyLower()
Change the case of the key to lowercase
#### Parameters:
* **$array** input array (array)

### Method arrayKeyUpper()
Change the case of the key to lowercase
#### Parameters:
* **$array** input array (array)

### Method generateTable()
Generate a html table from an array
#### Parameters:
* **$array** input array (array|null)
* **$css** if true then it uses the build in style. If false then it doesn't use style. If string then it uses as class (string|bool)

### Method splitOpeningClosing()
Split a string using an opening and closing tag, by default "(" and ")".<br/>
Example:<br/>
```
CollectionLib::splitOpeningClosing("a(B,C,D)e(F,G,H)"); // ['a','B,C,D','e','F,G,H']
CollectionLib::splitOpeningClosing("a(B,C,D)e(F,G,H)i"); // ['a','B,C,D','e','F,G,H','i']
```
#### Parameters:
* **$text** input text to separated (string)
* **$openingTag** Opening tag, default "(" (string)
* **$closingTag** closing tag, default ")" (string)
* **$startPosition** start position (by default it is zero) (int)
* **$excludeEmpty** if true then it excludes all empty values. (bool)
* **$includeTag** if true then it includes the tag. (bool)

### Method splitNotString()
Split a string by ignoring parts of string where values are between " or '.<br>
Example:<br/>
```
CollectionLib::splitNotString('a,b,"CC,D,E",e,f' ,","); // ['a','b','CC,D,E','e','f']
```
#### Parameters:
* **$text** input text (string)
* **$separator** param string $separator (string)
* **$offset** param int $offset (int)
* **$excludeEmpty** param bool $excludeEmpty (bool)

### Method arrayChangeKeyCaseRecursive()
It changes the case (to lower or upper case) of the keys of an array recursively<br>
**Example:**
```
$arr=['A'=>'a','b'=>'b'];
CollectionLib::arrayChangeKeyCaseRecursive($arr);
// returns ['a'=>'a','b'=>'b']
CollectionLib::arrayChangeKeyCaseRecursive($arr,true);
// returns ['A'=>'a','B'=>'b']
```
#### Parameters:
* **$array** input array (array)
* **$case** [optional] by default is CASE_LOWER <p>
  Either CASE_UPPER or
  CASE_LOWER (default)</p> (int)

### Method arraySearchField()
It returns the first (or all) key(s) inside an array/object in an array that matches the value of the field<br>
**Example:**
```
$array=[['name'=>'john'],['name'=>'mary']];
CollectionLib::arraySearchField($array,'name','mary'); // 1
CollectionLib::arraySearchField([(object)['name'=>'john'],(object)['name'=>'mary']],'name','mary'); // 1
CollectionLib::arraySearchField([['name'=>'john'],['name'=>'mary'],['name'=>'mary']],'name','mary',true); // returns [1,2]
```
#### Parameters:
* **$array** input array (array)
* **$fieldName** name of index of the field (string|int)
* **$value** value to search (mixed)
* **$returnAll** if true then it returns all matches. If false it returns the first value. (bool)

### Method xmlToString()
It converts a xml (SimpleXMLElement object) into a string<br>
**Example:**
```
$string=CollectionLib::xmlToString($xml,true); // "<root>...</root>"
```
#### Parameters:
* **$xml** param SimpleXMLElement $xml (SimpleXMLElement)
* **$format** if true then the result is formatted. (bool)

### Method arrayToXML()
It convers an array into a xml (SimpleXMLElement object)
**Example:**
```
$xml=CollectionLib::arrayToXML($array,'root'); // <root>...</root>
```
#### Parameters:
* **$data** param array $data (array)
* **$rootName** The name of the root tag (default root) (string)
* **$insidetag** It is used to fix a specific condition with the xml generated by PHP. (string)

### Method stringToXML()
It converts a string into a xml (SimpleXMLElement object) using simplexml_load_string including a fix<br>
**Example:**
```
$xml=CollectionLib::stringToXML('<root><item arg="1">a</item><item arg="2">b</item></root>');
```
#### Parameters:
* **$string** the value to convert (string)
* **$className** param null $className (null)
* **$options** libxml options (int)
* **$insidetag** by default is 'value_inside'. In some cases, the parser fails to generate an XML
  attribute when the child is empty <tag a='1'>2</tag>. The solution is to generate
  a new tag <tag a='1'><_value>2</_value></tag> (string)

### Method xmlToArray()
It converts an XML class (SimpleXMLElement object) into an array.
**Example:**
```
$array=CollectionLib::xmlToArray($xml);
```
#### Parameters:
* **$xml** param SimpleXMLElement $xml (SimpleXMLElement)

## DebugLib
Class Debug

### Method var_dump()
Alternative to var_dump. It "pre" the result or it shows the result in the console of javascript.<br>
**Example:**
```
DebugLib::var_dump($value,true); // returns a var_dump visible via the console of javascript (browser)
```
#### Parameters:
* **$value** param $value ()
* **$type** : 0=normal (<pre>), 1=javascript console, 2=table (use future) (int)
* **$returnValue** param bool $returnValue (bool)

### Method WriteLog()
Write a log file. If the file is over 10mb then the file is resetted.<br>
```
DebugLib::WriteLog('somefile.txt','warning','it is a warning');
DebugLib::WriteLog('somefile.txt','it is a warning');
```
#### Parameters:
* **$logFile** The file to write (string)
* **$level** The level of the message, example "error", "info", 1, etc. (mixed)
* **$txt** if txt is empty then level is defined as warning and level is used for the description (string|object|array)

## TextLib
Class TextLib

### Method isUpper()
Returns true if the str is (completelly) uppercase
#### Parameters:
* **$str** Input text (string)

### Method isLower()
Returns true if the str is (completelly) lowercase
#### Parameters:
* **$str** param $str ()

### Method between()
Obtain a string between one text and other.
**Example:**
```
TextLib::between('Hello Brave World','Hello','World');  // returns " Brave "
TextLib::between('mary has a lamb','has','lamb') // returns ' a '
```
#### Parameters:
* **$haystack** param string $haystack (string)
* **$startNeedle** The initial text to search<br />
  if empty then it starts at the start of the haystack. (string)
* **$endNeedle** The end tag to search<br />
  if empty then it ends at the end of the haystack (string)
* **$offset** param null|int $offset (null|int)
* **$ignoreCase** param bool $ignoreCase (bool)

### Method stripQuotes()
Strip quotes of a text " or ' if the value in between quotes<br>
If the value is not quoted then it is not touched.<br>
If the value is not correctly closed ("hello or "hello' ), then the quota is not removed.<br>
The value is trimmed '   "hello world"' --> 'hello world'<br>
**Example:**
```
TextLib::stripQuotes('"hello world"');
// returns hello world
```
#### Parameters:
* **$text** param $text ()

### Method removeParenthesis()
Remove the initial and final parenthesis but only if both matches.<br/>
If the $start and $end are arrays then both must have the same count and arrays are compared by pair of index<br>
**Example:**
```
TextLib::removeParenthesis('hello'); // return "hello";
TextLib::removeParenthesis('(hello)'); // return "hello";
TextLib::removeParenthesis('[hello]'
,['(','{','[']
,[')','}',']']); // returns "hello"
TextLib::removeParenthesis("'hello'"
,"'"
,"'"); // returns "hello"
```
#### Parameters:
* **$txt** Input value. Example "hello", "(hello)" (string)
* **$start** the open parenthesis, by default it's '('. (string|array)
* **$end** the close parenthesis, by default it's ')'. (string|array)

### Method replaceBetween()
Replace the text between two needles<br>
**Example:**
```
TextLib::replaceBetween('Hello Brave World','Hello','World',' Wayne ') // returns "Hello Wayne World"
```
#### Parameters:
* **$haystack** the input value (string)
* **$startNeedle** The initial text to search<br />
  if empty then it starts at the start of the haystack. (string)
* **$endNeedle** The end tag to search<br />
  if empty then it ends at the end of the haystack (string)
* **$replaceText** Text to replace (string)
* **$offset** the offset position to start the search. (null|int)
* **$replaceTag** If true then it also replaces the tags (bool)

### Method removeFirstChars()
Remove the first character(s) for a string<br>
**Example:**
```
TextLib::removeFirstChars('Hello') // returns "ello"
```
#### Parameters:
* **$str** The input text (string)
* **$length** The amount of characters to remove (default 1) (int)

### Method removeLastChars()
Remove the last character(s) for a string<br>
**Example:**
```
TextLib::removeLastChars('Hello') // returns "Hell"
```
#### Parameters:
* **$str** The input text (string)
* **$length** The amount of characters to remove (default 1) (int)

### Method getArgument()
It separates an argument from the value to the set value.<br>
Returns an array with the name of the argument and value (if any). It always returns a two dimension array
**Example:**
```
self::getArgument("arg=200"); // returns ["arg","200"]
self::getArgument("arg:200",':'); // returns ["arg","200"]
```
#### Parameters:
* **$str** The input text (string)
* **$set** The separator of operator (string)
* **$trimValue** param bool $trimValue (bool)

### Method strPosNotSpace()
It returns the first non-space position inside a string.
**Example:**
```
TextLib::strPosNotSpace('   abc  def'); // returns 3
```
#### Parameters:
* **$str** input string (string)
* **$offset** offset position (int)
* **$charlist** list of characters considered as space (string)

### Method strposArray()
It finds the first (or last) ocurrence of a text.<br>
Unlikely strpos(), this method allows finding more than one neddle.<br>
**Example:**
```
TextLib::strposArray('a,b.d.e,f.g',['x','t','.']); // return 3
TextLib::strposArray('a,b.d.e,f.g',['x','t',','],0,true); // return 7
```
#### Parameters:
* **$haystack** the input value (string)
* **$needles** the value (or values) to find (string|array)
* **$offset** the offset position (initially it's 0) (int)
* **$last** if false (default) it returns the first ocurrence. If true returns the last one (bool)

### Method parseArg()
It transforms a text = 'a1=1,a2=2' into an associative array<br/>
It uses the method parse_str() to do the conversion<br/>
**Note:** It doesn't work with quotes or double quotes. a1="aa,bb",bb=30 doesn't work
**Example:**
```
TextLib::parseArg('a=1,b=1'); // returns ['a'=>'1','b'=>'1']
```
#### Parameters:
* **$text** The input string with the initial values (string)
* **$separator** The separator (string)

### Method parseArg2()
It's the same than parseArg() but it's x3 times slower.<br>
It also considers quotes and doubles quotes.<br>
Example:
```
TextLib::parseArg2("a1=1,a2=2,a3="aa,bb"); // ["a1"=>1,"a2"=>2,"a3"=>""aa,bb""]
TextLib::parseArg("a1=1,a2=2,a3="aa,bb"); // ["a1"=>1,"a2"=>2,"a3"=>""aa","bb""=>""]
```
#### Parameters:
* **$text** The input string with the initial values (string)
* **$separator** The separator. It does not separates text inside quotes or double-quotes. (string)

### Method naturalArg()
It parses a natural string and returns a declarative array<br>
A "natural string", it is a set of values or arguments separated by space
, where a value is the index and the new one is the value of the index.
```
TextLib::naturalArg('select * from table where 1=1'
,['select'=>'req','from'=>'req','where'=>'opt']);
// returns ['select'=>'*','from'=>'table','where'=>'1=1']
TextLib::naturalArg('item export table inport file'
,['item'=>'first','export'=>'opt','inport'=>'opt']);
// returns: ['item' => 'item', 'export' => 'table', 'inport' => 'file']
```
#### Parameters:
* **$txt** the input value. Example "somevalue TYPE int LENGHT 30" (string)
* **$separators** the indicator for each field.<br>
  first = indicates the first element (optional)<br>
  opt = indicates the field is optional<br>
  req = indicates the field is required <br> (array)

### Method str_replace_ex()
It works as str_replace, but it also allows to limit the number of replacements.
#### Parameters:
* **$search** param string $search (string)
* **$replace** param string $replace (string)
* **$subject** param string $subject (string)
* **$limit** param int $limit (int)

### Method wildCardComparison()
It compares with wildcards (*) and returns true if both strings are equals<br>
The wildcards only works at the beginning or at the end of the string.<br>
<b>Example:<b><br>
```
TextLib::wildCardComparison('abcdef','abc*'); // true
TextLib::wildCardComparison('abcdef','*def'); // true
TextLib::wildCardComparison('abcdef','*abc*'); // true
TextLib::wildCardComparison('abcdef','*cde*'); // true
TextLib::wildCardComparison('abcdef','*cde'); // false
```
#### Parameters:
* **$text** param string $text (string)
* **$textWithWildcard** param string|null $textWithWildcard (string|null)

### Method endsWith()
it returns true if $string ends with $endString<br>
<b>Example:<b><br>
```
TextLib::endsWidth('hello world','world'); // true
```
#### Parameters:
* **$string** param $string ()
* **$endString** param $endString ()

### Method replaceCurlyVariable()
Replaces all variables defined between {{ }} by a variable inside the dictionary of values.<br>
Example:<br>
replaceCurlyVariable('hello={{var}}',['var'=>'world']) // hello=world<br>
replaceCurlyVariable('hello={{var}}',['varx'=>'world']) // hello=<br>
replaceCurlyVariable('hello={{var}}',['varx'=>'world'],true) // hello={{var}}<br>
#### Parameters:
* **$string** The input value. It could contain variables defined as {{namevar}} (string)
* **$values** The dictionary of values. (array)
* **$notFoundThenKeep** [false] If true and the value is not found, then it keeps the value.
  Otherwise, it is replaced by an empty value (bool)

### Method addParenthesis()
It adds a parenthesis (or other symbol) at the start and end of the text.
If it already has it, then it is not added.<br>
**Example:**
```
TextLib::addParenthesis('hello'); // return '(hello)';
TextLib::addParenthesis('(hello)');// return '(hello)';
```
#### Parameters:
* **$txt** Input value. Example "hello", "(hello)" (string)
* **$start** the open parenthesis, by default it's '('. (string|array)
* **$end** the close parenthesis, by default it's ')'. (string|array)

### Method hasParenthesis()
It returns true if the text has an open and ending parenthesis (or other symbol).<br>
**Example:**
```
TextLib::hasParenthesis('hello'); // return false;
TextLib::hasParenthesis('(hello)'); // return true;
```
#### Parameters:
* **$txt** Input value. Example "hello", "(hello)" (string)
* **$start** the open parenthesis, by default it's '('. (string|array)
* **$end** the close parenthesis, by default it's ')'. (string|array)

### Method camelCase()
Retains the case minus the first letter that it's converted in lowercase<br>
If the text contains the characters "_" or " ", then the next character is uppercase<br>
If the text does not contain any character "_" or " ", then only the first character is replaced.
**Example:**
```
TextLib::camelCase('HelloWorld'); // return "helloWorld";
TextLib::camelCase('hello_world'); // return "helloWorld";
```
#### Parameters:
* **$txt** input value (string)



## FileLib
Class Files<br>
This class has a collection of functions to interact with files and directories.
### Field lastError ()


### Method getDirFiles()
It gets the content (files) of a directory. It does not include other directories.
#### Parameters:
* **$dir** The directory to scan. (string)
* **$extensions** The extension to find (without dot). ['*'] means any extension. (array)
* **$recursive** if true (default), then it scans the folders recursively. (bool)

### Method getDirFirstFile()
It returns the first file (exclude directories) find in a directory that matches a specific extension(s)<br>
The order of the extensions could count.<br>
If there are two files with the same extension, then it returns the first one.
#### Parameters:
* **$dir** The directory to scan. (string)
* **$extensions** The extension to find (without dot). ['*'] means any extension. (array)
* **$sort** (default false), if true then it sorts the list previous the filter. (bool)
* **$descending** (default false), if true then it sorts (if enable) descending. (bool)

### Method getDirFolders()
It gets the content (folders) of a directory without trailing slash. It does not include files.
#### Parameters:
* **$dir** The directory to scan. (string)
* **$recursive** if true (default), then it scans the folders recursively. (bool)

### Method getExtensionPath()
It gets the extension of a file (without dot). If the file has no extension then it returns empty.
#### Parameters:
* **$fullPath** the path to analize. (string)

### Method getFileNamePath()
It gets the filename (without extension and directory)
#### Parameters:
* **$fullPath** the path to analize. (string)

### Method getBaseNamePath()
It gets the base name (filename with extension). It does not include the directory.
#### Parameters:
* **$fullPath** the path to analize. (string)

### Method getDirPath()
It gets the dir from a full path (without trailing slash)
#### Parameters:
* **$fullPath** the path to analize. (string)

### Method fixUrlSeparator()
It fixes the path by converting the slash and inverse lash into the system folder separator
#### Parameters:
* **$fullPath** the path to analize. (string)

### Method safeFileGetContent()
It gets the content of a file. It never throws an exception<br>
In case of error, it returns the default value
#### Parameters:
* **$filename** The filename to open. (string)
* **$use_include_path** used to trigger include path search. (bool)
* **$context** A valid context resource created with (null)
* **$offset** The offset where the reading starts. (int)
* **$length** Maximum length of data read. The default is to read until end
  of file is reached. (int|null)
* **$default** The value to return if it is unable to open the file (null|mixed)

### Method safeFilePutContent()
Write a string to a file. This operator is safe, it never throws an exception.
#### Parameters:
* **$filename** Path to the file where to write the data. (string)
* **$data** The data to write. Can be either a string, an array or a stream resource. (mixed)
* **$flag** The value of flags can be any combination of the following flags, with some
  restrictions, joined with the binary OR (|) operator. (int)
* **$context** A valid context resource created with stream_context_create. (mixed)
* **$tries** The number of tries (default 3). Every try has a delay of 300ms. (int)

### Method isAbsolutePath()
Returns true if the path is absolute, otherwise it returns false.<br>
This function works in Linux and Windows (and most probably in other UNIX OS)
#### Parameters:
* **$fullPath** The path to analize. (string)

## Version list
* 1.26 2026-01-01
  * updated WebLib 
* 1.25 2025-10-07
  * updated argument types.
* 1.24 
  * Fixed an exception with FileLib. It also stores every error in a field.
  * Completed README.md
  * Cleaned PHPDocs.
* 1.23 Modified .gitattributes and .gitignore to streamline the final version.
* 1.22 The next classes have been renamed:
  * Text (deprecated) => TextLib
  * Collection (deprecated)  => CollectionLib
  * Debug (deprecated) => DebugLib
  * It is because there are a dozen of libraries who use the same name for the classes.   
  * **You can still use the same library without changes** but for new code I suggest to use the new names.
  * [new] FileLib::getDirFirstFile()
* 1.21 added FileLib class
  * getDirFiles()
  * getDirFolders()
  * getExtensionPath()
  * getDirPath()
  * getBaseNamePath()
  * getFileNamePath()
  * fixUrlSeparator()
  * safeFileGetContent()
  * safeFilePutContent()
  * isAbsolutePath()
* 1.20 New methods CollectionLib::xmlToString,CollectionLib::arrayToXML,CollectionLib::stringToXML,CollectionLib::xmlToArray
* 1.17 New Method TextLib::str_replace_ex()
* 1.16 New methods TextLib::wildcardComparison() and TextLib::endsWith()   
* 1.15 New method TextLib::parseArg2()
* 1.14 TextLib::camelCase() solved a small bug  
* 1.13 TextLib::replaceCurlyVariable() updated
* 1.12
    * Collection:splitOpeningClosing added argument $includeTag
* 1.11
    * TextLib::replaceCurlyVariable Added method
* 1.10
    * TextLib::strPosNotSpace() added argument $charlist
* 1.9 2019-12-09
    * TextLib::replacetext() it does not crash if the end tag is missing.
    * TextLib::replacetext() it as a new argument
* 1.8 2019-12-04
    * TextLib::between() now allows empty $startNeedle and $endNeedle
* 1.7 2019-12-04 new methods
    * TextLib::addParenthesis()
    * TextLib::hasParenthesis()
* 1.6 2019-12-04 new methods
    * TextLib::parseArg()
    * TextLib::naturalArg()
    * TextLib::strposArray()
    * TextLib::camelCase()
    * TextLib::removeParenthesis()
    * CollectionLib::arrayChangeKeyCaseRecursive()
    * CollectionLib::arraySearchField()
* 1.5 2019-03-10 new functions:  
   Collection:splitOpeningClosing()  
   TextLib::strPosNotSpace()  
   TextLib::getArgument()  
   CollectionLib::splitNotString()  
* 1.4 2019-02-16 New functions TextLib::removeFirstChars(),TextLib::removeLastChars()
* 1.3 2019-02-16 Added new methods and Unit test.
* 1.2 2018-10-27 Some changes in the class collection.
* 1.0 2018-09-18 First version  

## License

Apache-2.0. 

