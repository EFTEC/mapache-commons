<?php

namespace mapache_commons;
use DateTime;

/**
 * Class Debug
 * @package mapache_commons
 * @version 1.1 2018-09-19
 * @copyright Jorge Castro Castillo
 * @license Apache-2.0
 * @see https://github.com/EFTEC/mapache-commons
 */
class Debug
{
    /**
     * @param $value
     * @param int $type: 0=normal (<pre>), 1=javascript console, 2=table (use future)
     * @see https://stackoverflow.com/questions/10116063/making-php-var-dump-values-display-one-line-per-value
     */
    public static function var_dump($value,$type=1) {
        switch ($type) {
            case 1:
                echo "<script>console.log(".json_encode($value).");</script>";
                break;
            case 2:
                echo "<pre>";
                var_dump($value);
                echo "</pre>";
                break;
            default:
                trigger_error("var_dump method not yet defined");
        }
    }

    /**
     * Write a log file. If the file is over 10mb then the file is resetted.<br>
     * <code>
     * Debug::WriteLog('somefile.txt','warning','it is a warning');
     * Debug::WriteLog('somefile.txt','it is a warning');
     * </code>
     * @param mixed $logFile
     * @param mixed $level
     * @param string $txt if txt is empty then level is defined as warning and level is used for the description
     */
    public static function WriteLog($logFile,$level,$txt='')
    {
        if ($logFile == '') {
            return;
        }
        $fz = @filesize($logFile);
        if (empty($txt)) {
            $txt=$level;
            $level='WARNING';
        }
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
        @fwrite($fp, $now->format('Y-m-d H:i:s') . "\t".$level."\t". $txtW . "\n");
        @fclose($fp);
    }
}