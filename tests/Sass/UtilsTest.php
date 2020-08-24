<?php

/**
 * @copyright 2020 Anthon Pang
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace ScssPhp\Tests;

use PHPUnit\Framework\TestCase;
use Sass\Utils;

/**
 * Utils test
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class UtilsTest extends TestCase
{
    /**
     * @param mixed $expected
     * @param mixed $input
     *
     * @dataProvider provideFlattenVertically
     */
    public function testFlattenVertically($expected, $input)
    {
        $this->assertSame($expected, Utils::flattenVertically($input));
    }

    public static function provideFlattenVertically()
    {
        return [
            [['1a', '2a', '1b', '2b'], [['1a', '1b'], ['2a', '2b']]],
        ];
    }
}
