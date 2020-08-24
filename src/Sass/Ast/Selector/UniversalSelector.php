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
 * Matches any element in the given namespace.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class UniversalSelector extends SimpleSelector
{
    /**
     * @var QualifiedName
     */
    public $namespace;

    public function __construct(QualifiedName $namespace)
    {
        $this->namespace = $namespace;
    }

    public function minSpecificity()
    {
        return 1;
    }

    public function accept($visitor)
    {
        return $visitor->visitUniversalSelector($this);
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

        if ($this->namespace !== null && $namespace !== '*') {
            return \array_merge([$this], $compound);
        }

        if (count($compound)) {
            return $compound;
        }

        return [$this];
    }

    public function __toString()
    {
        return __CLASS__ . "\0{$this->namespace}";
    }
}
