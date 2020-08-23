<?php

/**
 * @copyright 2020 Anthon Pang
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace ScssPhp\Tests;

use PHPUnit\Framework\TestCase;
use ScssPhp\ArrayUtils;

/**
 * ArrayUtils test
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class ArrayUtilsTest extends TestCase
{
    /**
     * @param mixed    $expected
     * @param mixed    $input
     * @param callable $callback
     *
     * @dataProvider provideAny
     */
    public function testAny($expected, $input, $callback)
    {
        $this->assertSame($expected, ArrayUtils::any($input, $callback));
    }

    /**
     * @return array
     */
    public static function provideAny()
    {
        return [
            [true, [0, 1, 'two'], 'is_string'],
            [false, [0, 1, 2], 'is_string'],
        ];
    }

    /**
     * @param mixed    $expected
     * @param mixed    $input
     * @param callable $callback
     *
     * @dataProvider provideExpand
     */
    public function testExpand($expected, $input, $callback)
    {
        $this->assertSame($expected, ArrayUtils::expand($input, $callback));
    }

    /**
     * @return array
     */
    public static function provideExpand()
    {
        return [
            [[1, 2, 3, 4], [[1, 2], [3, 4]], function ($e) { return $e; }],
        ];
    }
}
