<?php
/**
 * @copyright 2020 Anthon Pang
 * @license https://opensource.org/licenses/MIT MIT
 */
namespace DartLang\Path;

/**
 * Emulate package:path/path.dart
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class Path
{
    public $url; // basename(), withoutExtension(), isRelative(), isRootRelative()
    public $windows; // isAbsolute(), toUri()

    public static function absolute()
    {
    }

    public static function basename()
    {
    }

    public static function canonicalize()
    {
    }

    public static function dirname()
    {
    }

    /**
     * Gets the file extension of path: the portion of basename from the last .
     * to the end (including the . itself).
     *
     * @param string $path
     *
     * @return string
     */
    public static function extension($path)
    {
        $pathParts = \path_info($path, PATHINFO_EXTENSION);

        return $pathParts;
    }

    public static function equals()
    {
    }

    public static function fromUri()
    {
    }

    public static function isAbsolute()
    {
    }

    public static function isWithin()
    {
    }

    public static function join()
    {
    }

    public static function prettyUri()
    {
    }

    public static function relative()
    {
    }

    public static function setExtension()
    {
    }

    public static function toUri()
    {
    }
}
