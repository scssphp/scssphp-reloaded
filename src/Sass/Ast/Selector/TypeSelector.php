<?php

/**
 * @copyright 2018 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/selector/simple.dart@20978e03
 */

namespace Sass\Ast\Selector;

use Sass\Ast\SimpleSelector;
use Sass\Ast\Selector\QualifiedName;
use Sass\Ast\Selector\TypeSelector;
use Sass\Ast\Selector\UniversalSelector;

/**
 * A type selector.
 *
 * This selects elements whose name equals the given name.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class TypeSelector extends TypeSelector
{
    /**
     * @var QualifiedName
     */
    public $name;

    public function __construct(QualifiedName $name)
    {
        $this->name = $name;
    }

    public function minSpecificity()
    {
        return 1;
    }

    public function accept($visitor)
    {
        return $visitor->visitTypeSelector($this);
    }

    public function addSuffix($suffix)
    {
        return new TypeSelector(
            new QualifiedName(
                $this->name->name . $suffix,
                ['namespace' => $this->name->namespace]
            )
        );
    }

    public function unify(array $compound)
    {
        $universal = count($compound) &&
            (ArrayUtils::first($compound) instanceof UniversalSelector ||
            ArrayUtils::first($compound) instanceof TypeSelector);

        if ($universal) {
            $unified = unifyUniversalAndElement($this, ArrayUtils::first($compound));

            if (\is_null($unified)) {
                return null;
            }

            return \array_merge($unified, ArrayUtils::skip($compound, 1));
        }

        \array_unshift($compound, $this);

        return $compound;
    }

    public function __toString()
    {
        return __CLASS__ . "\0{$this->name}";
    }
}
