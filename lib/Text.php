<?php

namespace mapache_commons;

/**
 * Class Text
 * @package mapache_commons
 * @version 1.0 2018-09-18
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
}