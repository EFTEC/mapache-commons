<?php /** @noinspection UnknownInspectionInspection */

namespace mapache_commons;

use RuntimeException;

/**
 * Class WebLib
 *
 * @package   mapache_commons
 * @version   1.26 2026-01-01
 * @copyright Jorge Castro Castillo
 * @license   Apache-2.0
 * @see       https://github.com/EFTEC/mapache-commons
 */
class WebLib
{
    /**
     *
     * @noinspection PhpComposerExtensionStubsInspection
     */
    public static function sendWeb($url, $method, $fields, $headers = ['Content-Type: application/json'])
    {
        $method = strtoupper($method);
        if (!function_exists('curl_version')) {
            throw new RuntimeException('CURL is not installed');
        }
        $ch = curl_init();
        switch ( $method) {
            case 'POST':
                if(is_array($fields)) {
                    $fields_string = http_build_query($fields);
                } else {
                    $fields_string = $fields;
                }
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                break;
            case 'GET':
                $url .= '?' . http_build_query($fields);
                curl_setopt($ch, CURLOPT_POST, false);
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }

    /**
     * It gets the raw body of a request, for example a post
     * @param $resultOnError
     * @return false|mixed|string|null
     */
    public static function getPostBody($resultOnError=null) {
        return file_get_contents('php://input')?? $resultOnError;
    }
}
