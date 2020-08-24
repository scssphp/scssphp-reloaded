<?php

/**
 * @copyright 2018 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/selector/simple.dart@20978e03
 */

namespace Sass\Ast\Selector;

use Sass\Ast\Selector\SimpleSelector;

/**
 * A selector that matches the parent in the Sass stylesheet.
 *
 * This is not a plain CSS selector—it should be removed before emitting a CSS
 * document.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class ParentSelector extends SimpleSelector
{
    /**
     * The suffix that will be added to the parent selector after it's been
     * resolved.
     *
     * This is assumed to be a valid identifier suffix. It may be `null`,
     * indicating that the parent selector will not be modified.
     *
     * @var string
     */
    public $suffix;

    public function __construct($suffix)
    {
        $this->suffix = $suffix;
    }

    public function accept($visitor)
    {
        return $visitor->visitParentSelector($this);
    }

    public function unify($compound)
    {
        throw new UnsupportedError("& doesn't support unification.");
    }
}
