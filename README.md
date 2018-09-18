# Mapache Commons
It's a set of useful functions for PHP. The name is a pun (Mapache in spanish is "raccoon")

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

### isAssoc($array)

### first($array)

### firstKey($array)

### arrayKeyLower($arr)

### arrayKeyUpper($arr)

### generateTable($array,$css=true)

## Debug

### var_dump($value,$console=false)

### WriteLog($logFile,$txt)

## Text

### isUpper($str)

### isLower($str)

## Version list

* 1.0 2018-09-18 First version  

## License

Apache-2.0. 

