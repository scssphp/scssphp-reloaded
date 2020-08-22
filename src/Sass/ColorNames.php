<?php

/**
 * @copyright 2018 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/color_names.dart@7933e9e6
 */

namespace Sass;

use Sass\Value\SassColor;
use ScssPhp\SingletonTrait;

class ColorNames
{
    use SingletonTrait;

    /**
     * A map from (lowercase) color names to their color values.
     *
     * @var array
     */
    public static $colorsByName;

    /**
     * A map from Sass colors to (lowercase) color names.
     *
     * @var array
     */
    public static $namesByColor;

    final private function __construct()
    {
        // Note: these are in reverse alphabetical order so that colors with multiple
        // names will use the alphabetically first option in [namesByColor].
        static::$colorsByName = [
            'yellowgreen' => SassColor::rgb(0x9A, 0xCD, 0x32),
            'yellow' => SassColor::rgb(0xFF, 0xFF, 0x00),
            'whitesmoke' => SassColor::rgb(0xF5, 0xF5, 0xF5),
            'white' => SassColor::rgb(0xFF, 0xFF, 0xFF),
            'wheat' => SassColor::rgb(0xF5, 0xDE, 0xB3),
            'violet' => SassColor::rgb(0xEE, 0x82, 0xEE),
            'turquoise' => SassColor::rgb(0x40, 0xE0, 0xD0),
            'transparent' => SassColor::rgb(0, 0, 0, 0),
            'tomato' => SassColor::rgb(0xFF, 0x63, 0x47),
            'thistle' => SassColor::rgb(0xD8, 0xBF, 0xD8),
            'teal' => SassColor::rgb(0x00, 0x80, 0x80),
            'tan' => SassColor::rgb(0xD2, 0xB4, 0x8C),
            'steelblue' => SassColor::rgb(0x46, 0x82, 0xB4),
            'springgreen' => SassColor::rgb(0x00, 0xFF, 0x7F),
            'snow' => SassColor::rgb(0xFF, 0xFA, 0xFA),
            'slategrey' => SassColor::rgb(0x70, 0x80, 0x90),
            'slategray' => SassColor::rgb(0x70, 0x80, 0x90),
            'slateblue' => SassColor::rgb(0x6A, 0x5A, 0xCD),
            'skyblue' => SassColor::rgb(0x87, 0xCE, 0xEB),
            'silver' => SassColor::rgb(0xC0, 0xC0, 0xC0),
            'sienna' => SassColor::rgb(0xA0, 0x52, 0x2D),
            'seashell' => SassColor::rgb(0xFF, 0xF5, 0xEE),
            'seagreen' => SassColor::rgb(0x2E, 0x8B, 0x57),
            'sandybrown' => SassColor::rgb(0xF4, 0xA4, 0x60),
            'salmon' => SassColor::rgb(0xFA, 0x80, 0x72),
            'saddlebrown' => SassColor::rgb(0x8B, 0x45, 0x13),
            'royalblue' => SassColor::rgb(0x41, 0x69, 0xE1),
            'rosybrown' => SassColor::rgb(0xBC, 0x8F, 0x8F),
            'red' => SassColor::rgb(0xFF, 0x00, 0x00),
            'rebeccapurple' => SassColor::rgb(0x66, 0x33, 0x99),
            'purple' => SassColor::rgb(0x80, 0x00, 0x80),
            'powderblue' => SassColor::rgb(0xB0, 0xE0, 0xE6),
            'plum' => SassColor::rgb(0xDD, 0xA0, 0xDD),
            'pink' => SassColor::rgb(0xFF, 0xC0, 0xCB),
            'peru' => SassColor::rgb(0xCD, 0x85, 0x3F),
            'peachpuff' => SassColor::rgb(0xFF, 0xDA, 0xB9),
            'papayawhip' => SassColor::rgb(0xFF, 0xEF, 0xD5),
            'palevioletred' => SassColor::rgb(0xDB, 0x70, 0x93),
            'paleturquoise' => SassColor::rgb(0xAF, 0xEE, 0xEE),
            'palegreen' => SassColor::rgb(0x98, 0xFB, 0x98),
            'palegoldenrod' => SassColor::rgb(0xEE, 0xE8, 0xAA),
            'orchid' => SassColor::rgb(0xDA, 0x70, 0xD6),
            'orangered' => SassColor::rgb(0xFF, 0x45, 0x00),
            'orange' => SassColor::rgb(0xFF, 0xA5, 0x00),
            'olivedrab' => SassColor::rgb(0x6B, 0x8E, 0x23),
            'olive' => SassColor::rgb(0x80, 0x80, 0x00),
            'oldlace' => SassColor::rgb(0xFD, 0xF5, 0xE6),
            'navy' => SassColor::rgb(0x00, 0x00, 0x80),
            'navajowhite' => SassColor::rgb(0xFF, 0xDE, 0xAD),
            'moccasin' => SassColor::rgb(0xFF, 0xE4, 0xB5),
            'mistyrose' => SassColor::rgb(0xFF, 0xE4, 0xE1),
            'mintcream' => SassColor::rgb(0xF5, 0xFF, 0xFA),
            'midnightblue' => SassColor::rgb(0x19, 0x19, 0x70),
            'mediumvioletred' => SassColor::rgb(0xC7, 0x15, 0x85),
            'mediumturquoise' => SassColor::rgb(0x48, 0xD1, 0xCC),
            'mediumspringgreen' => SassColor::rgb(0x00, 0xFA, 0x9A),
            'mediumslateblue' => SassColor::rgb(0x7B, 0x68, 0xEE),
            'mediumseagreen' => SassColor::rgb(0x3C, 0xB3, 0x71),
            'mediumpurple' => SassColor::rgb(0x93, 0x70, 0xDB),
            'mediumorchid' => SassColor::rgb(0xBA, 0x55, 0xD3),
            'mediumblue' => SassColor::rgb(0x00, 0x00, 0xCD),
            'mediumaquamarine' => SassColor::rgb(0x66, 0xCD, 0xAA),
            'maroon' => SassColor::rgb(0x80, 0x00, 0x00),
            'magenta' => SassColor::rgb(0xFF, 0x00, 0xFF),
            'linen' => SassColor::rgb(0xFA, 0xF0, 0xE6),
            'limegreen' => SassColor::rgb(0x32, 0xCD, 0x32),
            'lime' => SassColor::rgb(0x00, 0xFF, 0x00),
            'lightyellow' => SassColor::rgb(0xFF, 0xFF, 0xE0),
            'lightsteelblue' => SassColor::rgb(0xB0, 0xC4, 0xDE),
            'lightslategrey' => SassColor::rgb(0x77, 0x88, 0x99),
            'lightslategray' => SassColor::rgb(0x77, 0x88, 0x99),
            'lightskyblue' => SassColor::rgb(0x87, 0xCE, 0xFA),
            'lightseagreen' => SassColor::rgb(0x20, 0xB2, 0xAA),
            'lightsalmon' => SassColor::rgb(0xFF, 0xA0, 0x7A),
            'lightpink' => SassColor::rgb(0xFF, 0xB6, 0xC1),
            'lightgrey' => SassColor::rgb(0xD3, 0xD3, 0xD3),
            'lightgreen' => SassColor::rgb(0x90, 0xEE, 0x90),
            'lightgray' => SassColor::rgb(0xD3, 0xD3, 0xD3),
            'lightgoldenrodyellow' => SassColor::rgb(0xFA, 0xFA, 0xD2),
            'lightcyan' => SassColor::rgb(0xE0, 0xFF, 0xFF),
            'lightcoral' => SassColor::rgb(0xF0, 0x80, 0x80),
            'lightblue' => SassColor::rgb(0xAD, 0xD8, 0xE6),
            'lemonchiffon' => SassColor::rgb(0xFF, 0xFA, 0xCD),
            'lawngreen' => SassColor::rgb(0x7C, 0xFC, 0x00),
            'lavenderblush' => SassColor::rgb(0xFF, 0xF0, 0xF5),
            'lavender' => SassColor::rgb(0xE6, 0xE6, 0xFA),
            'khaki' => SassColor::rgb(0xF0, 0xE6, 0x8C),
            'ivory' => SassColor::rgb(0xFF, 0xFF, 0xF0),
            'indigo' => SassColor::rgb(0x4B, 0x00, 0x82),
            'indianred' => SassColor::rgb(0xCD, 0x5C, 0x5C),
            'hotpink' => SassColor::rgb(0xFF, 0x69, 0xB4),
            'honeydew' => SassColor::rgb(0xF0, 0xFF, 0xF0),
            'grey' => SassColor::rgb(0x80, 0x80, 0x80),
            'greenyellow' => SassColor::rgb(0xAD, 0xFF, 0x2F),
            'green' => SassColor::rgb(0x00, 0x80, 0x00),
            'gray' => SassColor::rgb(0x80, 0x80, 0x80),
            'goldenrod' => SassColor::rgb(0xDA, 0xA5, 0x20),
            'gold' => SassColor::rgb(0xFF, 0xD7, 0x00),
            'ghostwhite' => SassColor::rgb(0xF8, 0xF8, 0xFF),
            'gainsboro' => SassColor::rgb(0xDC, 0xDC, 0xDC),
            'fuchsia' => SassColor::rgb(0xFF, 0x00, 0xFF),
            'forestgreen' => SassColor::rgb(0x22, 0x8B, 0x22),
            'floralwhite' => SassColor::rgb(0xFF, 0xFA, 0xF0),
            'firebrick' => SassColor::rgb(0xB2, 0x22, 0x22),
            'dodgerblue' => SassColor::rgb(0x1E, 0x90, 0xFF),
            'dimgrey' => SassColor::rgb(0x69, 0x69, 0x69),
            'dimgray' => SassColor::rgb(0x69, 0x69, 0x69),
            'deepskyblue' => SassColor::rgb(0x00, 0xBF, 0xFF),
            'deeppink' => SassColor::rgb(0xFF, 0x14, 0x93),
            'darkviolet' => SassColor::rgb(0x94, 0x00, 0xD3),
            'darkturquoise' => SassColor::rgb(0x00, 0xCE, 0xD1),
            'darkslategrey' => SassColor::rgb(0x2F, 0x4F, 0x4F),
            'darkslategray' => SassColor::rgb(0x2F, 0x4F, 0x4F),
            'darkslateblue' => SassColor::rgb(0x48, 0x3D, 0x8B),
            'darkseagreen' => SassColor::rgb(0x8F, 0xBC, 0x8F),
            'darksalmon' => SassColor::rgb(0xE9, 0x96, 0x7A),
            'darkred' => SassColor::rgb(0x8B, 0x00, 0x00),
            'darkorchid' => SassColor::rgb(0x99, 0x32, 0xCC),
            'darkorange' => SassColor::rgb(0xFF, 0x8C, 0x00),
            'darkolivegreen' => SassColor::rgb(0x55, 0x6B, 0x2F),
            'darkmagenta' => SassColor::rgb(0x8B, 0x00, 0x8B),
            'darkkhaki' => SassColor::rgb(0xBD, 0xB7, 0x6B),
            'darkgrey' => SassColor::rgb(0xA9, 0xA9, 0xA9),
            'darkgreen' => SassColor::rgb(0x00, 0x64, 0x00),
            'darkgray' => SassColor::rgb(0xA9, 0xA9, 0xA9),
            'darkgoldenrod' => SassColor::rgb(0xB8, 0x86, 0x0B),
            'darkcyan' => SassColor::rgb(0x00, 0x8B, 0x8B),
            'darkblue' => SassColor::rgb(0x00, 0x00, 0x8B),
            'cyan' => SassColor::rgb(0x00, 0xFF, 0xFF),
            'crimson' => SassColor::rgb(0xDC, 0x14, 0x3C),
            'cornsilk' => SassColor::rgb(0xFF, 0xF8, 0xDC),
            'cornflowerblue' => SassColor::rgb(0x64, 0x95, 0xED),
            'coral' => SassColor::rgb(0xFF, 0x7F, 0x50),
            'chocolate' => SassColor::rgb(0xD2, 0x69, 0x1E),
            'chartreuse' => SassColor::rgb(0x7F, 0xFF, 0x00),
            'cadetblue' => SassColor::rgb(0x5F, 0x9E, 0xA0),
            'burlywood' => SassColor::rgb(0xDE, 0xB8, 0x87),
            'brown' => SassColor::rgb(0xA5, 0x2A, 0x2A),
            'blueviolet' => SassColor::rgb(0x8A, 0x2B, 0xE2),
            'blue' => SassColor::rgb(0x00, 0x00, 0xFF),
            'blanchedalmond' => SassColor::rgb(0xFF, 0xEB, 0xCD),
            'black' => SassColor::rgb(0x00, 0x00, 0x00),
            'bisque' => SassColor::rgb(0xFF, 0xE4, 0xC4),
            'beige' => SassColor::rgb(0xF5, 0xF5, 0xDC),
            'azure' => SassColor::rgb(0xF0, 0xFF, 0xFF),
            'aquamarine' => SassColor::rgb(0x7F, 0xFF, 0xD4),
            'aqua' => SassColor::rgb(0x00, 0xFF, 0xFF),
            'antiquewhite' => SassColor::rgb(0xFA, 0xEB, 0xD7),
            'aliceblue' => SassColor::rgb(0xF0, 0xF8, 0xFF),
        ];

        static::$namesByColor = \array_reverse(static::$colorsByName);
    }
}

// phpcs:disable
ColorNames::getInstance();
