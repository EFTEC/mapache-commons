<?php /** @noinspection UnknownInspectionInspection */

namespace mapache_commons;

use RuntimeException;

/**
 * Class WebLib
 *
 * @package   mapache_commons
 * @version   1.24 2024-08-24
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
                $fields_string = http_build_query($fields);
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
}
