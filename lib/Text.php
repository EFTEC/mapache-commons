<?php

namespace mapache_commons;

/**
 * Class Text
 * @package mapache_commons
 * @version 1.5 2019-mar-10 11:49 AM  
 * @copyright Jorge Castro Castillo
 * @license Apache-2.0
 * @see https://github.com/EFTEC/mapache-commons
 */
class Text
{

    /**
     * Returns true if the str is (completelly) uppercase
     * @param $str
     * @return bool
     * @see https://stackoverflow.com/questions/4211875/check-if-a-string-is-all-caps-in-php
     */
    public static function isUpper($str) {
        return strtoupper($str) == $str;
    }
    /**
     * Returns true if the str is (completelly) lowercase
     * @param $str
     * @return bool
     * @see https://stackoverflow.com/questions/25340288/php-function-to-check-string-if-is-all-lowercase
     */
    public static function isLower($str) {
        return strtolower($str) == $str;
    }

	/**
	 * Obtain a string between one text and other.
	 * Example: between('mary has a lamb','has','lamb') // returns ' a '
	 * @param string $haystack
	 * @param string $startNeedle
	 * @param string $endNeedle
	 * @param null|int $offset
	 * @param bool $ignoreCase
	 * @return bool|string
	 */
	public static function between($haystack, $startNeedle, $endNeedle,&$offset=0, $ignoreCase=false){
		$ini =($ignoreCase)?@stripos($haystack, $startNeedle,$offset) : @strpos($haystack, $startNeedle,$offset);
		if ($ini === false) return false;
		$ini += strlen($startNeedle);
		$len =(($ignoreCase)? stripos($haystack, $endNeedle, $ini):strpos($haystack, $endNeedle, $ini) ) - $ini;
		$offset=$ini+$len;
		return substr($haystack, $ini, $len);
	}

	/**
	 * Strip quotes of a text (" or ')
	 * @param $text
	 * @return bool|string
	 */
	public static function stripQuotes($text) {
		if (!$text) return $text;
		$text=trim($text);
		$p0=substr($text,0,1); // first character
		$p1=substr($text,-1); // last character
		if ($p0==$p1 && ($p0=='"' || $p0=="'")) {
			return substr($text,1,strlen($text)-2);
		}
		return $text;
	}

	/**
	 * Replace the text between two needles
	 * @param $haystack
	 * @param $startNeedle
	 * @param $endneedle
	 * @param $replaceText
	 * @param int $offset
	 * @return bool|mixed
	 */
	public static function replaceBetween($haystack, $startNeedle, $endneedle, $replaceText, &$offset=0){
		$ini = strpos($haystack, $startNeedle,$offset);
		if ($ini === false) return false;
		$ini += strlen($startNeedle);
		$len = strpos($haystack, $endneedle, $ini) - $ini;
		$offset=$ini+$len;
		return substr_replace($haystack,$replaceText,$ini,$len);
	}

	/**
	 * Remove the first character(s) for a string
	 * @param string $txt
	 * @param int $length
	 * @return bool|string
	 */
	public static function removeFirstChars($txt,$length=1) {
		return substr($txt,$length);
	}

	/**
	 * Remove the last character(s) for a string
	 * @param string $txt
	 * @param int $length
	 * @return bool|string
	 */
	public static function removeLastChars($txt,$length=1) {
		return substr($txt,0,-$length);
	}

	/**
	 * It separates an argument from the value to the set value.
	 * Example self::getArgument("arg=200") returns ["arg","200"]
	 * Example self::getArgument("arg:200",':') returns ["arg","200"]
	 * @param string $txt
	 * @param string $set separator.
	 * @param bool $trimValue
	 * @return array it always returns a two dimensional array. It could returns [null,null] or ['arg',null]
	 */
	public static function getArgument($txt,$set='=',$trimValue=true) {
		if (empty($txt)) return [null,null];
		$parts=explode($set,$txt,2);
		if (count($parts)<2) {
			$parts[]=null;
		}
		$parts[0]=trim($parts[0]);
		if ($trimValue && $parts[1]) $parts[1]=trim($parts[1]);
		
		return $parts;
	}

	/**
	 * It returns the first not-space position inside a string.
	 * @param $txt
	 * @param int $offset offset position
	 * @return int
	 */
	public static function strPosNotSpace($txt,$offset=0) {
		$txtTmp=substr($txt,0,$offset).ltrim(substr($txt,$offset));
		return strlen($txt)-strlen($txtTmp)+$offset;
	}
	
}