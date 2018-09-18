<?php

namespace mapache_commons;
use DateTime;

/**
 * Class Debug
 * @package mapache_commons
 * @version 1.0 2018-09-18
 * @copyright Jorge Castro Castillo
 * @license Apache-2.0
 * @see https://github.com/EFTEC/mapache-commons
 */
class Debug
{
    /**
     * Alternative to var_dump. It <pre> the result or it shows the result in the console of javascript.
     * @param $value
     * @param bool $console true if you want to return the values in the javascript-console.
     * @see https://stackoverflow.com/questions/10116063/making-php-var-dump-values-display-one-line-per-value
     */
    public static function var_dump($value,$console=false) {
        if ($console) {
            echo "<script>console.log(".json_encode($value).");</script>";
        } else {
            echo "<pre>";
            var_dump($value);
            echo "</pre>";
        }
    }

    /**
     * Write a log file. If the file is over 10mb then the file is resetted.
     * @param $logFile
     * @param $txt
     */
    public static function WriteLog($logFile,$txt)
    {
        if ($logFile == '') {
            return;
        }
        $fz = @filesize($logFile);

        if (is_object($txt) || is_array($txt)) {
            $txtW = print_r($txt, true);
        } else {
            $txtW = $txt;
        }
        if ($fz > 10000000) {
            // max de 10mb
            $fp = @fopen($logFile, 'w');
        } else {
            $fp = @fopen($logFile, 'a');
        }
        $txtW = str_replace("\r\n", " ", $txtW);
        $txtW = str_replace("\n", " ", $txtW);
        $now = new DateTime();
        @fwrite($fp, $now->format('c') . "\t" . $txtW . "\n");
        @fclose($fp);
    }
}