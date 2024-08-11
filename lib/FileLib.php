<?php

namespace mapache_commons;

use Throwable;

/**
 * Class Files<br>
 * This class has a collection of functions to interact with files and directories.
 *
 * @package   mapache_commons
 * @version   1.22 2024-08-10
 * @copyright Jorge Castro Castillo
 * @license   Apache-2.0
 * @see       https://github.com/EFTEC/mapache-commons
 */
class FileLib
{
    /**
     * It gets the content (files) of a directory. It does not include other directories.
     * @param string $dir        The directory to scan.
     * @param array  $extensions The extension to find (without dot). ['*'] means any extension.
     * @param bool   $recursive  if true (default), then it scans the folders recursively.
     * @return array
     */
    public static function getDirFiles(string $dir, array $extensions = ['*'], bool $recursive = true): array
    {
        $result = [];
        return self::_getDirFiles($dir, $result, $extensions, $recursive);
    }

    /**
     * It returns the first file (exclude directories) find in a directory that matches a specific extension(s)<br>
     * The order of the extensions could count.<br>
     * If there are two files with the same extension, then it returns the first one.
     * @param string $dir        The directory to scan.
     * @param array  $extensions The extension to find (without dot). ['*'] means any extension.
     * @param bool   $sort       (default false), if true then it sorts the list previous the filter.
     * @param bool   $descending (default false), if true then it sorts (if enable) descending.
     * @return string|null The full name of the file or null if it is not found.
     */
    public static function getDirFirstFile(string $dir, array $extensions = ['*'],bool $sort=false,$descending=false): ?string
    {
        $files = scandir($dir);
        if($sort) {
            $files=natcasesort($files);
        }
        if($descending && $sort) {
            $files=array_reverse($files);
        }
        foreach ($extensions as $ext) {
            foreach ($files as $value) {
                $fullName = realpath($dir . DIRECTORY_SEPARATOR . $value);
                $extension = self::getExtensionPath($fullName);
                if (!is_dir($fullName)) {
                    if ($extension === $ext || $ext === '*') {
                        return $fullName;
                    }
                }
            }
        }
        return null;
    }

    protected static function _getDirFiles(string $dir, array &$results = [], array $extensions = ['*'], bool $recursive = true): array
    {
        $files = scandir($dir);
        foreach ($files as $value) {
            $fullName = realpath($dir . DIRECTORY_SEPARATOR . $value);
            $extension = self::getExtensionPath($fullName);
            if (!is_dir($fullName)) {
                $endsWith = false;
                foreach ($extensions as $ext) {
                    if ($extension === $ext || $ext === '*') {
                        $endsWith = true;
                        break;
                    }
                }
                if ($endsWith) {
                    $results[] = $fullName;
                }
            } else if ($value !== "." && $value !== ".." && $recursive) {
                self::_getDirFiles($fullName, $results, $extensions);
                //$results[] = $fullName;
            }
        }
        return $results;
    }

    /**
     * It gets the content (folders) of a directory without trailing slash. It does not include files.
     * @param string $dir       The directory to scan.
     * @param bool   $recursive if true (default), then it scans the folders recursively.
     * @return array
     */
    public static function getDirFolders(string $dir, bool $recursive = true): array
    {
        $result = [];
        return self::_getDirFolders($dir, $result, $recursive);
    }

    protected static function _getDirFolders(string $dir, array &$results = [], bool $recursive = true): array
    {
        $files = scandir($dir);
        foreach ($files as $value) {
            $fullName = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if ($value !== "." && $value !== ".." && is_dir($fullName)) {
                $results[] = $fullName;
                if ($recursive) {
                    self::_getDirFolders($fullName, $results);
                }
            }
        }
        return $results;
    }

    /**
     * It gets the extension of a file (without dot). If the file has no extension then it returns empty.
     * @param string $fullPath the path to analize.
     * @return string
     */
    public static function getExtensionPath(string $fullPath): string
    {
        return pathinfo($fullPath, PATHINFO_EXTENSION);
    }

    /**
     * It gets the filename (without extension and directory)
     * @param string $fullPath the path to analize.
     * @return string
     */
    public static function getFileNamePath(string $fullPath): string
    {
        return pathinfo($fullPath,PATHINFO_FILENAME);
    }

    /**
     * It gets the base name (filename with extension). It does not include the directory.
     * @param string $fullPath the path to analize.
     * @return string
     */
    public static function getBaseNamePath(string $fullPath): string
    {
        return pathinfo($fullPath,PATHINFO_BASENAME);
    }

    /**
     * It gets the dir from a full path (without trailing slash)
     * @param string $fullPath the path to analize.
     * @return string
     */
    public static function getDirPath(string $fullPath): string
    {
        return pathinfo($fullPath,PATHINFO_DIRNAME);
    }

    /**
     * It fixes the path by converting the slash and inverse lash into the system folder separator
     * @param string $fullPath the path to analize.
     * @return string
     */
    public static function fixUrlSeparator(string $fullPath): string
    {
        return str_replace(['\\', '/'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $fullPath);
    }

    /**
     * It gets the content of a file. It never throws an exception<br>
     * In case of error, it returns the default value
     * @param string     $filename         The filename to open.
     * @param bool       $use_include_path used to trigger include path search.
     * @param null       $context          A valid context resource created with
     * @param int        $offset           The offset where the reading starts.
     * @param int|null   $length           Maximum length of data read. The default is to read until end
     *                                     of file is reached.
     * @param null|mixed $default          The value to return if it is unable to open the file
     * @return mixed|string|null
     */
    public static function safeFileGetContent(string $filename, bool $use_include_path = false, $context = null,
                                              int    $offset = 0, ?int $length = null, $default = null)
    {
        try {
            $content = $length === null ?
                file_get_contents($filename, $use_include_path, $context, $offset) :
                file_get_contents($filename, $use_include_path, $context, $offset, $length);
            $content = $content === false ? $default : $content;
        } catch (Throwable $e) {
            $content = $default;
        }
        return $content;
    }

    /**
     * Write a string to a file. This operator is safe, it never throws an exception.
     * @param string $filename Path to the file where to write the data.
     * @param mixed  $data     The data to write. Can be either a string, an array or a stream resource.
     * @param int    $flag     The value of flags can be any combination of the following flags, with some
     *                         restrictions, joined with the binary OR (|) operator.
     * @param mixed  $context  A valid context resource created with stream_context_create.
     * @param int    $tries    The number of tries (default 3). Every try has a delay of 300ms.
     * @return bool true if the operation was successful, otherwise false.
     */
    public static function safeFilePutContent(string $filename, $data = "", int $flag = 0,
                                              $context = null, int $tries = 3): bool
    {
        for ($try = 0; $try < $tries; $try++) {
            try {
                $result = file_put_contents($filename, $data, $flag, $context);
                if ($result !== false) {
                    return true;
                }
            } catch (Throwable $e) {
            }
            usleep(300);
        }
        return false;
    }

    /**
     * Returns true if the path is absolute, otherwise it returns false.<br>
     * This function works in Linux and Windows (and most probably in other UNIX OS)
     * @param string $fullPath The path to analize.
     * @return bool
     */
    public static function isAbsolutePath(string $fullPath): bool {
        if(PHP_OS_FAMILY==='Windows') {
            return (strlen($fullPath)>1 && $fullPath[1]===':'); // example: c:\path or c:/path
        }
        return ($fullPath !== '' && $fullPath[0]==='/'); // example: /path1
    }
}