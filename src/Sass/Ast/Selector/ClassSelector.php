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
 * A class selector.
 *
 * This selects elements whose `class` attribute contains an identifier with
 * the given name.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class ClassSelector extends SimpleSelector
{
    /**
     * The class name this selects for.
     *
     * @var string
     */
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function accept($visitor)
    {
        return $visitor->visitClassSelector($this);
    }

    public function addSufix($suffix)
    {
        return new ClassSelector($this->name . $suffix);
    }

    public function __toString()
    {
        return __CLASS__ . '\0{$this->name}';
    }
}
