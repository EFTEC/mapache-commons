# Mapache Commons
It's a set of useful functions for PHP. The name is a pun (Mapache in spanish is "raccoon")

[![Build Status](https://travis-ci.org/EFTEC/mapache-commons.svg?branch=master)](https://travis-ci.org/EFTEC/mapache-commons)
[![Packagist](https://img.shields.io/packagist/v/eftec/mapache-commons.svg)](https://packagist.org/packages/eftec/mapache-commons)
[![Maintenance](https://img.shields.io/maintenance/yes/2020.svg)]()
[![composer](https://img.shields.io/badge/composer-%3E1.6-blue.svg)]()
[![php](https://img.shields.io/badge/php->5.6-green.svg)]()
[![php](https://img.shields.io/badge/php-7.x-green.svg)]()
[![CocoaPods](https://img.shields.io/badge/docs-70%25-yellow.svg)]()

- [Mapache Commons](#mapache-commons)
  * [Goals](#goals)
  * [Families](#families)
  * [Collection](#collection)
    + [isAssoc($array)](#isassoc--array-)
    + [first($array)](#first--array-)
    + [firstKey($array)](#firstkey--array-)
    + [arrayKeyLower($arr)](#arraykeylower--arr-)
    + [arrayKeyUpper($arr)](#arraykeyupper--arr-)
    + [generateTable($array,$css=true)](#generatetable--array--css-true-)
  * [Debug](#debug)
    + [var_dump($value,$console=false)](#var-dump--value--console-false-)
    + [WriteLog($logFile,$txt)](#writelog--logfile--txt-)
  * [Text](#text)
    + [isUpper($str)](#isupper--str-)
    + [isLower($str)](#islower--str-)
  * [Version list](#version-list)
  * [License](#license)

![Mapache Commons](docs/raccoon_small.png)  
__Mapache Commons__

## Goals

It's a set of useful function with the next requirements:
* The function mustn't have dependencies (unless it requires a php module).  
* The function must be FAST and memory friendly over the syntax sugar.
* The function must be able to run statically and it must be self contained.
* The function must be generic and it must solve generic problems.  For example, a function that calculates the VAT of a specific country is not allowed.  

## Families
* Collection
* Text
* Debug

## Collection
It's a class with a collection of functions related with arrays and lists.

### splitOpeningClosing

> splitOpeningClosing($text,[$openingTag='('],[$closingTag=')'],[$startPosition=0],[$excludeEmpty=true],[$includeTag=false])

Split a string by an opening and closing tag and returns an array with the result.

> splitOpeningClosing('hello(a,b,c)world(d,e,f)')
> returns ['hello','a,b,c','world','d,e,f']

> splitOpeningClosing{'hello{a,b,c}world{d,e,f}','{','}')
> returns ['hello','a,b,c','world','d,e,f']


> splitOpeningClosing('hello(a,b(,c)world(d,e,f)')
> returns ['hello','a,b(,c','world','d,e,f']

### splitNotString

Split a string by ignoring parts of string where values are between " or '.

> splitNotString($text,$separator,[$offset=0],[$excludeEmpty=true])

```php
Collection::splitNotString('a,b,"CC,D,E",e,f' , ",");
// returns ['a' , 'b' , 'CC,D,E' , 'e' , 'f']
```

### arrayChangeKeyCaseRecursive

It changes the case (to lower or upper case) of the keys of an array recursively

> arrayChangeKeyCaseRecursive($arr,$case=CASE_LOWER/CASE_UPPER)

```php
$arr=['A'=>'a','b'=>'b'];
Collection::arrayChangeKeyCaseRecursive($arr);
// returns ['a'=>'a','b'=>'b']
Collection::arrayChangeKeyCaseRecursive($arr,true);
// returns ['A'=>'a','B'=>'b']
```
### arraySearchField

It returns the first (or all) key(s) inside an array/object in an array that matches the value of the field<br>

For example, let's say the next array

[
    ['name'=>'john'],
    ['name'=>'mary']
]

And we want to find the first "name" equals to "mary"

```php
$array=[]; // our array with all data
$key=arraySearchField($array,'name','mary');
```

> arraySearchField($array,$fieldName,$value)

```php
Collection::arraySearchField(
    [['name'=>'john'],['name'=>'mary']],'name','mary');
// returns 1

Collection::arraySearchField(
    [(object)['name'=>'john'],(object)['name'=>'mary']],'name','mary');
// returns 1
Collection::arraySearchField(
    [['name'=>'john'],['name'=>'mary'],['name'=>'mary']],'name','mary',true);
// returns [1,2]
              
```


### isAssoc

> isAssoc($array)

Returns true if array is an associative array, false is it's an indexed array


### first

> first($array)

Returns the first element of an array.  
Sometimes the first element is not the index [0], for example ['key1'=>1,0=2] where the first element is 'key1' and not 0. 
This function always returns the right value.

### firstKey

> firstKey($array)

Returns the first key of an array.
###  arrayKeyLower

> arrayKeyLower($arr)

Change the case of all the keys to lowercase
### arrayKeyUpper 

>arrayKeyUpper($arr)

Change the case of all the keys to lowercase
### generateTable 

>generateTable($array,$css=true)

Generate a html table from an array
## Debug
It's a class with a collection of functions related with debug.
### var_dump

>var_dump($value,$console=false)

Alternative to var_dump. It "pre" the result or it shows the result in the console of javascript.

>var_dump($value,true) // returns a var_dump visible via the console of javascript (browser)

### WriteLog

>WriteLog($logFile,$txt)

It writes a log file and adds the txt to the log.  If the log file is full (10mb) then it's emptied.

## Text
It's a class with a collection of functions related with strings.


### getArgument()

> Text::getArgument($txt,[$set='='],[$trimValue=true])

Returns an array with the name of the argument and value (if any). It always returns a two dimension array

> Example Text::getArgument('alpha=hello')
> ['alpha','hello']

> Example Text::getArgument('alpha:hello',':')
> ['alpha','hello']

### strPosNotSpace()

> Text::strPosNotSpace($txt,[$offset=0])

Returns the first position of a string that it's not a space

```php
Text::strPosNotSpace('   abc  def');
// returns 3

```

### isUpper 

> isUpper($str)

Returns true if the str is (completelly) uppercase

### isLower

> isLower($str)

Returns true if the str is (completelly) lowercase

### stripQuotes

> stripQuotes($text)

Strip quotes of a text (" or ')

Example:
```php
Text::stripQuotes('"hello world"');
// returns hello world
```

* If the value is not quoted then it is not touched.  
* If the value is not correctly closed ("hello or "hello' ), then the quota is not removed.  
* The value is trimmed '   "hello world"' --> 'hello world'

### between

> between($haystack, $startNeedle, $endNeedle,&$offset=0, $ignoreCase=false)   

Returns the text between two needles.

> Text::between('Hello Brave World','Hello','World')  // returns " Brave "

### replaceBetween 

> replaceBetween($haystack, $startNeedle, $endneedle, $replaceText, &$offset=0,$$replaceTag=false)

Replace the text between two needles
* If $replaceTag is true then it also replaces the $startNeedle and $endneedle

> Text::replaceBetween('Hello Brave World','Hello','World',' Wayne ') // returns "Hello Wayne World"



### removeFirstChars 

> removeFirstChars($txt,$length=1)

Remove the first character(s) for a string

> Text::removeFirstChars('Hello') // returns "ello"

### removeLastChars 

> removeLastChars($txt,$length=1)

Remove the last character(s) for a string

> Text::removeLastChars('Hello') // returns "Hell"

### parseArg

It transforms a text = 'a1=1,a2=2' into an associative array.
It uses the method parse_str() to do the conversion

> parseArg($text, $separator = ',')

```php
Text::parseArg('a=1,b=1');
// returns ['a'=>'1','b'=>'1']
```

### naturalArg

It parses a natural string and returns a declarative array.
A "natural string", it is a set of values or arguments separated by space
, where a value is the index and the new one is the value of the index.

> naturalArg($text, $separator = ',')

* $text the input expression
* $separator is a associative array where the key is the key of the
 end result, and the value of each key is 
   * first = first value. This value is the first of the string expression
   * req = required value. If the value is missing then it returns null
   * opt = optional value. If the value is missing the the field returns null

```php
Text::naturalArg('select * from table where 1=1'
                ,['select'=>'req','from'=>'req','where'=>'opt']);
// returns ['select'=>'*','from'=>'table','where'=>'1=1']

Text::naturalArg('item export table inport file'
                ,['item'=>'first','export'=>'opt','inport'=>'opt']);
// returns: ['item' => 'item', 'export' => 'table', 'inport' => 'file']
```

### camelCase

Retains the case of the text minus the first letter that it's converted in lowercase.

Example:
```php
Text::camelCase('HelloWorld');
// return "helloWorld";
Text::camelCase('hello_world');
// return "helloWorld";

```

### strposArray

It find the first (or last) ocurrence of a text.
Unlikely strpos(), this method allows to find more than one neddle.

> function strposArray($haystack, $needles,$offset=0,$last=false)

Example:
```php
Text::strposArray('a,b.d.e,f.g',['x','t','.']);
// return 3
Text::strposArray('a,b.d.e,f.g',['x','t',','],0,true);
// return 7
```

### removeParenthesis

Remove the initial and final parenthesis but only if both matches.   
If the **$start** and **$end** arguments are arrays then both must have the same count and arrays are compared by pair of index

Example:
```php
Text::removeParenthesis('hello');
// return "hello";
Text::removeParenthesis('(hello)');
// return "hello";
Text::removeParenthesis('[hello]'
    ,['(','{','[']
    ,[')','}',']']);
// returns "hello"
Text::removeParenthesis("'hello'"
    ,"'"
    ,"'");
// returns "hello"
```

### hasParenthesis

Returns true if it has both parenthesis.


Example:
```php
Text::hasParenthesis('hello');
// return false;
Text::hasParenthesis('(hello)');
// return true;
```


### addParenthesis

It adds parenthesis only if the original input does not have it.

Example:
```php
Text::addParenthesis('hello');
// return '(hello)';
Text::addParenthesis('(hello)');
// return '(hello)';
```


## Version list

* 1.14 Text::camelCase() solved a small bug  
* 1.13 Text::replaceCurlyVariable() updated
* 1.12
    * Collection:splitOpeningClosing added argument $includeTag
* 1.11
    * Text::replaceCurlyVariable Added method
* 1.10
    * Text::strPosNotSpace() added argument $charlist
* 1.9 2019-12-09
    * Text::replacetext() it does not crashes if the end tag is missing.
    * Text::replacetext() it as a new argument
* 1.8 2019-12-04
    * Text::between() now allows empty $startNeedle and $endNeedle
* 1.7 2019-12-04 new methods
    * Text::addParenthesis()
    * Text::hasParenthesis()
* 1.6 2019-12-04 new methods
    * Text::parseArg()
    * Text::naturalArg()
    * Text::strposArray()
    * Text::camelCase()
    * Text::removeParenthesis()
    * Collection::arrayChangeKeyCaseRecursive()
    * Collection::arraySearchField()
* 1.5 2019-03-10 new functions:  
   Collection:splitOpeningClosing()  
   Text::strPosNotSpace()  
   Text::getArgument()  
   Collection::splitNotString()  
* 1.4 2019-02-16 New functions Text::removeFirstChars(),Text::removeLastChars()
* 1.3 2019-02-16 Added new methods and Unit test.
* 1.2 2018-10-27 Some changes in the class collection.
* 1.0 2018-09-18 First version  

## License

Apache-2.0. 

