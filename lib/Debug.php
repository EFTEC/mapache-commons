<?php
/** @noinspection UnknownInspectionInspection */

/** @noinspection ReturnTypeCanBeDeclaredInspection */

/** @noinspection BadExpressionStatementJS */

namespace mapache_commons;

use DateTime;
use Exception;

/**
 * Class Debug
 *
 * @package   mapache_commons
 * @version   1.6 2019-dic.-4 8:38 p. m. 
 * @copyright Jorge Castro Castillo
 * @license   Apache-2.0
 * @see       https://github.com/EFTEC/mapache-commons
 */
class Debug {
    /**
     * @param      $value
     * @param int  $type : 0=normal (<pre>), 1=javascript console, 2=table (use future)
     * @param bool $returnValue
     *
     * @return string|void
     * @see https://stackoverflow.com/questions/10116063/making-php-var-dump-values-display-one-line-per-value
     * @noinspection JSUnnecessarySemicolon
     */
    public static function var_dump($value, $type = 1, $returnValue = false) {
        switch ($type) {
            case 1:
                $txt = "<script>console.log(" . json_encode($value) . ");</script>";
                break;
            case 2:
                $txt = "<pre>";
                $txt .= print_r($value, true);
                $txt .= "</pre>";
                break;
            default:
                trigger_error("var_dump method not yet defined");
                DIE(1);
        }
        if ($returnValue) {
            return $txt;
        }
        echo $txt;
    }

    /**
     * Write a log file. If the file is over 10mb then the file is resetted.<br>
     * <code>
     * Debug::WriteLog('somefile.txt','warning','it is a warning');
     * Debug::WriteLog('somefile.txt','it is a warning');
     * </code>
     *
     * @param mixed  $logFile
     * @param mixed  $level
     * @param string|object|array $txt if txt is empty then level is defined as warning and level is used for the description
     *
     * @return bool
     */
    public static function WriteLog($logFile, $level, $txt = '') {
        if ($logFile == '') {
            return false;
        }
        $fz = @filesize($logFile);
        if (empty($txt)) {
            $txt = $level;
            $level = 'WARNING';
        }
        if (is_object($txt) || is_array($txt)) {
            $txtW = print_r($txt, true);
        } else {
            $txtW = $txt;
        }
        if ($fz > 10000000) {
            // max de 10mb
            $fp = @fopen($logFile, 'wb');
        } else {
            $fp = @fopen($logFile, 'ab');
        }
        if (!$fp) {
            return false;
        }
        $txtW = str_replace(array("\r\n", "\n"), " ", $txtW);
        $r = true;
        try {
            $now = new DateTime();
            @fwrite($fp, @$now->format('Y-m-d H:i:s') . "\t" . $level . "\t" . $txtW . "\n");
        } catch (Exception $e) {
            $r = false;
        }
        @fclose($fp);
        return $r;
    }
}