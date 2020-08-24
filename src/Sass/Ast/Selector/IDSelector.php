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
use ScssPhp\ArrayUtils;

/**
 * An ID selector.
 *
 * This selects elements whose `id` attribute exactly matches the given name.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class IDSelector extends SimpleSelector
{
    /**
     * The ID name this selects for.
     *
     * @var string
     */
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function minSpecificity()
    {
        return \pow(parent::minSpecificity(), 2);
    }

    public function accept($visitor)
    {
        return $visitor->visitIDSelector($this);
    }

    public function addSufix($suffix)
    {
        return new IDSelector($this->name . $suffix);
    }

    public function unify(array $compound)
    {
        // A given compound selector may only contain one ID.
        $anyOtherID = ArrayUtils::any(
            $compound,
            function ($simple) {
                return $simple instanceof IDSelector && $simple != $this;
            }
        );

        if ($anyOtherID) {
            return null;
        }

        return parent::unify($compound);
    }

    public function __toString()
    {
        return __CLASS__ . '\0{$this->name}';
    }
}
