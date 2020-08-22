<?php

/**
 * @copyright 2018 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/utils.dart@6565b45
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */

namespace Sass;

use DartLang\Path\Path;

class Utils
{
    /**
     * The URL used in stack traces when no source URL is available.
     */
    private static function noSourceUrl()
    {
    }

    /**
     * Converts [iter] into a sentence, separating each word with [conjunction].
     *
     * @param
     * @param
     *
     * @return string
     */
    public static function toSentence()
    {
    }

    /**
     * Returns [string] with every line indented [indentation] spaces.
     *
     * @param string $string
     * @param int    $indentation
     *
     * @return string
     */
    public static function indent($string, $indentation)
    {
        return implode(
            "\n",
            array_map(public static function ($line) use ($indentation) {
                    return str_repeat(' ', $indentation) . $line;
            }, explode("\n", $string))
        );
    }

    public static function countOccurrences($string, $codeUnit)
    {
    }

    public static function trimAscii($string, $args)
    {
    }

    public static function trimAsciiLeft($string, $args)
    {
    }

    public static function trimAsciiRight($string, $args)
    {
    }

    private static function firstNonWhitespace($string)
    {
    }

    private static function lastNonWhitespace($string, $args)
    {
    }

    public static function isPublic(string $member)
    {
    }

    public static function flattenVertically()
    {
    }

    public static function firstOrNull()
    {
    }

    public static function codepointIndexToCodeUnitIndex()
    {
    }

    public static function codeUnitIndexToCodepointIndex()
    {
    }

    public static function iterableEquals()
    {
    }

    public static function iterableHash()
    {
    }

    public static function listEquals()
    {
    }

    public static function listHash()
    {
    }

    public static function mapEquals()
    {
    }

    public static function mapHash()
    {
    }

    public static function frameForSpan()
    {
    }

    public static function spanForList()
    {
    }

    public static function declarationName()
    {
    }

    public static function unvendor()
    {
    }

    public static function equalsIgnoreCase()
    {
    }

    public static function startsWithIgnoreCase()
    {
    }

    public static function mapInPlace()
    {
    }

    public static function longestCommonSubsequence()
    {
    }

    public static function backtrack()
    {
    }

    public static function removeFirstWhere()
    {
    }

    public static function mapAddAll2()
    {
    }

    public static function setAll()
    {
    }

    public static function rotateSlice()
    {
    }

    public static function mapAsync()
    {
    }

    public static function putIfAbsentAsync()
    {
    }

    public static function copyMapOfMap()
    {
    }

    public static function copyMapOfList()
    {
    }
}
