<?php

/**
 * @copyright 2018 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/selector/simple.dart@20978e03
 */

namespace Sass\Ast\Selector;

use Util\Character;
use Sass\Ast\Selector\SimpleSelector;

/**
 * A placeholder selector.
 *
 * This doesn't match any elements. It's intended to be extended using
 * `@extend`. It's not a plain CSS selector—it should be removed before
 * emitting a CSS document.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class PlaceholderSelector extends SimpleSelector
{
    /**
     * The name of the placeholder.
     *
     * @var string
     */
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function isInvisible()
    {
        return true;
    }

    /**
     * Returns whether this is a private selector (that is, whether it begins
     * with `-` or `_`).
     *
     * @return bool
     */
    public function isPrivate()
    {
        return Character::isPrivate($this->name);
    }

    public function accept($visitor)
    {
        return $visitor->visitPlaceholderSelector($this);
    }

    public function addSufix($suffix)
    {
        return new PlaceholderSelector($this->name . $suffix);
    }

    public function __toString()
    {
        return __CLASS__ . '\0{$this->name}';
    }
}
