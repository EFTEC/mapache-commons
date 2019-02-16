<?php

namespace mapache_commons;

/**
 * Class Text
 * @package mapache_commons
 * @version 1.3 2019-feb-16 10:02 AM 
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

	public static function replaceBetween($haystack, $startNeedle, $endneedle, $replaceText, &$offset=0){
		$ini = strpos($haystack, $startNeedle,$offset);
		if ($ini === false) return false;
		$ini += strlen($startNeedle);
		$len = strpos($haystack, $endneedle, $ini) - $ini;
		$offset=$ini+$len;
		return substr_replace($haystack,$replaceText,$ini,$len);
	}
}