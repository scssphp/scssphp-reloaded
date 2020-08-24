<?php

/**
 * @copyright 2020 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/selector/complex.dart@20978e03
 */

namespace Sass\Ast\Selector;

use Sass\Ast\Selector\ComplexSelectorComponentInterface;

/**
 * A combinator that defines the relationship between selectors in a
 * [ComplexSelector].
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class Combinator implements ComplexSelectorComponentInterface
{
    /**
     * The combinator's token text.
     *
     * @var string
     */
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Matches the right-hand selector if it's immediately adjacent to the
     * left-hand selector in the DOM tree.
     */
    public static function nextSibling()
    {
        return new Combinator('+');
    }

    /**
     * Matches the right-hand selector if it's a direct child of the left-hand
     * selector in the DOM tree.
     */
    public static function child()
    {
        return new Combinator('>');
    }

    /**
     * Matches the right-hand selector if it comes after the left-hand selector
     * in the DOM tree.
     */
    public static function followingSibling()
    {
        return new Combinator('~');
    }

    public function toString()
    {
        return $this->text;
    }
}
