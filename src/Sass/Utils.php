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
use ScssPhp\ArrayUtils;

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
            array_map(function ($line) use ($indentation) {
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

    /**
     * Flattens the first level of nested arrays in [iterable].
     *
     * The return value is ordered first by index in the nested iterable, then by
     * the index *of* that iterable in [iterable]. For example,
     * `flattenVertically([["1a", "1b"], ["2a", "2b"]])` returns `["1a", "2a",
     * "1b", "2b"]`.
     *
     * {@internal List.removeWhere() is only used once, so inlined here.
     *            Also, we avoid using array_filter() as it preserves array keys.}
     *
     * @param array $iterable
     *
     * @return array
     */
    public static function flattenVertically(array $iterable)
    {
        if (count($iterable) === 1) {
            return ArrayUtils::first($iterable);
        }

        $queues = $iterable;
        $result = [];

        while (count($queues)) {
            $result2 = [];

            foreach ($queues as &$queue) {
                $result[] = ArrayUtils::removeFirst($queue);

                if (count($queue)) {
                    $result2[] = $queue;
                }
            }
        
            $queues = $result2;
        }

        return $result;
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

    /**
     * Returns [name] without a vendor prefix.
     *
     * If [name] has no vendor prefix, it's returned as-is.
     *
     * @param string $name
     *
     * @return string
     */
    public static function unvendor($name)
    {
        if (strlen($name) < 2) {
            return $name;
        }

        if ($name[0] !== '-') {
            return $name;
        }

        if ($name[1] === '-') {
            return $name;
        }

        for ($i = 2; $i < strlen($name); $i++) {
            if ($name[$i] === '-') {
                return substr($name, $i + 1);
            }
        }

        return $name;
    }

    /**
     * Returns whether [string1] and [string2] are equal, ignoring ASCII case.
     *
     * @param string $string1
     * @param string $string2
     *
     * @return bool
     */
    public static function equalsIgnoreCase($string1, $string2)
    {
        if ($string1 === $string2) {
            return true;
        }

        if (\is_null($string1) || \is_null($string2)) {
            return false;
        }

        if (\strlen($string1) !== \strlen($string2)) {
            return false;
        }

        for ($i = 0; $i < \strlen($string1); $i++) {
            if (! self::characterEqualsIgnoreCase($string1[$i], $string2[$i])) {
                return false;
            }
        }

        return true;
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
