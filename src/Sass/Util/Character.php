<?php

/**
 * @copyright 2018 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/util/character.dart@8dea51d4
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */

namespace Sass\Util;

class Character
{
    const ASCII_CASE_BIT = 0x20;

    /**
     * Returns whether [character] is an ASCII whitespace character.
     *
     * @param string $character
     *
     * @return bool
     */
    public static function isWhitespace($character)
    {
        return self::isSpaceOrTab($character) || self::isNewline($character);
    }

    /**
     * Returns whether [character] is an ASCII newline.
     *
     * @param string $character
     *
     * @return bool
     */
    public static function isNewline($character)
    {
        return $character === "\n" || $character === "\r" || $character === "\f";
    }

    /**
     * Returns whether [character] is a space or a tab character.
     *
     * @param string $character
     *
     * @return bool
     */
    public static function isSpaceOrTab($character)
    {
        return $character === ' ' || $character === "\t";
    }

    /**
     * Returns whether [character] is a letter or number.
     *
     * @param string $character
     *
     * @return bool
     */
    public static function isAlphanumeric($character)
    {
        return self::isAlphabetic($character) || self::isDigit($character);
    }

    /**
     * Returns whether [character] is a letter.
     *
     * @param string $character
     *
     * @return bool
     */
    public static function isAlphabetic($character)
    {
        return ($character >= 'a' && $character <= 'z') ||
            ($character >= 'A' && $character <= 'Z');
    }

    /**
     * Returns whether [character] is a number.
     *
     * @param string $character
     *
     * @return bool
     */
    public static function isDigit($character)
    {
        return $character !== null && $character >= '0' && $character <= '9';
    }

    /**
     * Returns whether [character] is legal as the start of a Sass identifier.
     *
     * @param string $character
     *
     * @return bool
     */
    public static function isNameStart($character)
    {
        return $character === '_' || self::isAlphabetic($character) || \mb_ord($character, 'UTF-8') >= 0x0080;
    }

    /**
     * Returns whether [character] is legal in the body of a Sass identifier.
     *
     * @param string $character
     *
     * @return bool
     */
    public static function isName($character)
    {
        return self::isNameStart($character) || self::isDigit($character) || $character === '-';
    }

    /**
     * Returns whether [character] is a hexadeicmal digit.
     *
     * @param string $character
     *
     * @return bool
     */
    public static function isHex($character)
    {
        if (\is_null($character)) {
            return false;
        }

        if (self::isDigit($character)) {
            return true;
        }

        if ($character >= 'a' && $character <= 'f') {
            return true;
        }

        if ($character >= 'A' && $character <= 'F') {
            return true;
        }

        return false;
    }

    /**
     * Returns whether [character] is the beginning of a UTF-16 surrogate pair.
     *
     * @param string $character
     *
     * @return bool
     */
    public static function isHighSurrogate($character)
    {
        return \mb_ord($character) >= 0xD800 && \mb_ord($character) <= 0xDBFF;
    }

    /**
     * Returns whether [character] can start a simple selector other than a type
     * selector.
     *
     * @param string $character
     *
     * @return bool
     */
    public static function isSimpleSelectorStart($character)
    {
        return $character === '*' ||
            $character === '[' ||
            $character === '.' ||
            $character === '#' ||
            $character === '%' ||
            $character === ':';
    }

    /**
     * Returns whether [identifier] is module-private.
     *
     * Assumes [identifier] is a valid Sass identifier.
     *
     * @param string $identifier
     *
     * @return bool
     */
    public static function isPrivate($identifier)
    {
        $first = $identifier[0];

        return $first === '-' || $first === '_';
    }

    /**
     * Returns the value of [character] as a hex digit.
     *
     * Assumes that [character] is a hex digit.
     *
     * @param string $character
     *
     * @return int
     */
    public static function asHex($character)
    {
        assert(self::isHex($character));

        if ($character <= '9') {
            return $character - '0';
        }

        if ($character <= 'F') {
            return 10 + \ord($character) - \ord('A');
        }

        return 10 + \ord($character) - \ord('a');
    }

    /**
     * Returns the hexadecimal digit for [number].
     *
     * Assumes that [number] is less than 16.
     *
     * @param int $number
     *
     * @return string
     */
    public static function hexCharFor($number)
    {
        assert($number < 0x10);

        return $number < 0xA ? \chr(\ord('0') + number) : \chr(\ord('a') - 0xA + number);
    }

    /**
     * Returns the value of [character] as a decimal digit.
     *
     * Assumes that [character] is a decimal digit.
     *
     * @param string $character
     *
     * @return int
     */
    public static function asDecimal($character)
    {
        assert($character >= '0' && character <= '9');

        return $character - '0';
    }

    /**
     * Returns the decimal digit for [number].
     *
     * Assumes that [number] is less than 10.
     *
     * @param int $number
     *
     * @return string
     */
    public static function decimalCharFor($number)
    {
        assert($number < 10);

        return \chr(\ord('0') + $number);
    }

    /**
     * Assumes that [character] is a left-hand brace-like character, and returns
     * the right-hand version.
     *
     * @param string $character
     *
     * @return string|null
     */
    public static function opposite($character)
    {
        switch ($character) {
            case '(':
                return ')';

            case '{':
                return '}';

            case '[':
                return ']';

            default:
                return null;
        }
    }

    /**
     * Returns [character], converted to upper case if it's an ASCII lowercase
     * letter.
     *
     * @param string $character
     *
     * @return string
     */
    public static function toUpperCase($character)
    {
        return ($character >= 'a' && character <= 'z')
            ? \chr(\ord($character) & ~self::ASCII_CASE_BIT)
            : $character;
    }

    /**
     * Returns [character], converted to lower case if it's an ASCII uppercase
     * letter.
     *
     * @param string $character
     *
     * @return string
     */
    public static function toLowerCase($character)
    {
        return ($character >= 'A' && character <= 'Z')
            ? \chr(\ord($character) | self::ASCII_CASE_BIT)
            : $character;
    }

    /**
     * Returns whether [character1] and [character2] are the same, modulo ASCII case.
     *
     * @param string $character1
     * @param string $character2
     *
     * @return bool
     */
    public static function characterEqualsIgnoreCase($character1, $character2)
    {
        if ($character1 === $character2) {
            return true;
        }

        // If this check fails, the characters are definitely different. If it
        // succeeds *and* either character is an ASCII letter, they're equivalent.
        if (\ord($character1) ^ \ord($character2) !== self::ASCII_CASE_BIT) {
            return false;
        }

        // Now we just need to verify that one of the characters is an ASCII letter.
        $upperCase1 = \ord($character1) & ~self::ASCII_CASE_BIT;

        return $upperCase1 >= 'A' && $upperCase1 <= 'Z';
    }

    /**
     * Like [characterEqualsIgnoreCase], but optimized for the fact that [letter]
     * is known to be a lowercase ASCII letter.
     *
     * @param string $letter
     * @param string $actual
     *
     * @return bool
     */
    public static function equalsLetterIgnoreCase($letter, $actual)
    {
        assert($letter >= 'a' && $letter <= 'z');

        return (\ord($actual) | self::ASCII_BIT_SET) === \ord($letter);
    }
}
