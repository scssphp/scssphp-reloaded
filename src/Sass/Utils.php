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
namespace Sass
{
    use DartLang\Path\Path;

    /**
     * The URL used in stack traces when no source URL is available.
     */
    function _noSourceUrl()
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
    function toSentence()
    {
    }

    /**
     * Returns [string] with every line indented [indentation] spaces.
     *
     * @param string  $string
     * @param integer $indentation
     *
     * @return string
     */
    function indent($string, $indentation)
    {
        return implode("\n",
            array_map(function ($line) use ($indentation)
                {
                    return str_repeat(' ', $indentation) . $line;
                },
                explode("\n", $string)
            )
        );
    }

    function countOccurrences($string, $codeUnit)
    {
    }

    function trimAscii($string, $args)
    {
    }

    function trimAsciiLeft($string, $args)
    {
    }

    function trimAsciiRight($string, $args)
    {
    }

    function _firstNonWhitespace($string)
    {
    }

    function _lastNonWhitespace($string, $args)
    {
    }

    function isPublic(string $member)
    {
    }

    function flattenVertically()
    {
    }

    function firstOrNull()
    {
    }

    function codepointIndexToCodeUnitIndex()
    {
    }

    function codeUnitIndexToCodepointIndex()
    {
    }

    function iterableEquals()
    {
    }

    function iterableHash()
    {
    }

    function listEquals()
    {
    }

    function listHash()
    {
    }

    function mapEquals()
    {
    }

    function mapHash()
    {
    }

    function frameForSpan()
    {
    }

    function spanForList()
    {
    }

    function declarationName()
    {
    }

    function unvendor()
    {
    }

    function equalsIgnoreCase()
    {
    }

    function startsWithIgnoreCase()
    {
    }

    function mapInPlace()
    {
    }

    function longestCommonSubsequence()
    {
    }

    function backtrack()
    {
    }

    function removeFirstWhere()
    {
    }

    function mapAddAll2()
    {
    }

    function setAll()
    {
    }

    function rotateSlice()
    {
    }

    function mapAsync()
    {
    }

    function putIfAbsentAsync()
    {
    }

    function copyMapOfMap()
    {
    }

    function copyMapOfList()
    {
    }
}
