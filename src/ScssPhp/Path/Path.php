<?php
/**
 * @copyright 2020 Anthon Pang
 * @license https://opensource.org/licenses/MIT MIT
 */
namespace ScssPhp\Path;

/**
 * Emulate package:path/path.dart
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class Path
{
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
}
