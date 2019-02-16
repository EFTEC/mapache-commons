# Mapache Commons
It's a set of useful functions for PHP. The name is a pun (Mapache in spanish is "raccoon")

[![Build Status](https://travis-ci.org/EFTEC/mapache-commons.svg?branch=master)](https://travis-ci.org/EFTEC/mapache-commons)
[![Packagist](https://img.shields.io/packagist/v/eftec/daoone.svg)](https://packagist.org/packages/eftec/mapache-commons)
[![Maintenance](https://img.shields.io/maintenance/yes/2019.svg)]()
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

### isAssoc($array)
Returns true if array is an associative array, false is it's an indexed array
### first($array)
Returns the first element of an array.
### firstKey($array)
Returns the first key of an array.
### arrayKeyLower($arr)
Change the case of all the keys to lowercase
### arrayKeyUpper($arr)
Change the case of all the keys to lowercase
### generateTable($array,$css=true)
Generate a html table from an array
## Debug
It's a class with a collection of functions related with debug.
### var_dump($value,$console=false)
Alternative to var_dump. It "pre" the result or it shows the result in the console of javascript.
### WriteLog($logFile,$txt)
It writes a log file and adds the txt to the log.  If the log file is full (10mb) then it's emptied.
## Text
It's a class with a collection of functions related with strings.
### isUpper($str)
Returns true if the str is (completelly) uppercase
### isLower($str)
Returns true if the str is (completelly) lowercase
## Version list

* 1.3 2019-02-16 Added new methods and Unit test.
* 1.2 2018-10-27 Some changes in the class collection.
* 1.0 2018-09-18 First version  

## License

Apache-2.0. 

