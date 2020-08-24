<?php

/**
 * @copyright 2018 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/selector/simple.dart@20978e03
 */

namespace Sass\Ast\Selector;

use Sass\Ast\Selector\AttributeOperator;
use Sass\Ast\Selector\SimpleSelector;
use Sass\Ast\Selector\QualifiedName;

/**
 * An attribute selector.
 *
 * This selects for elements with the given attribute, and optionally with a
 * value matching certain conditions as well.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class AttributeSelector extends SimpleSelector
{
    /**
     * The name of the attribute being selected for.
     *
     * @var QualifiedName
     */
    public $name;

    /**
     * The operator that defines the semantics of [value].
     *
     * If this is `null`, this matches any element with the given property,
     * regardless of this value. It's `null` if and only if [value] is `null`.
     *
     * @var AttributeOperator
     */
    public $op;

    /**
     * An assertion about the value of [name].
     *
     * The precise semantics of this string are defined by [op].
     *
     * If this is `null`, this matches any element with the given property,
     * regardless of this value. It's `null` if and only if [op] is `null`.
     *
     * @var string
     */
    public $value;

    /**
     * The modifier which indicates how the attribute selector should be
     * processed.
     *
     * See for example [case-sensitivity][] modifiers.
     *
     * [case-sensitivity]: https://www.w3.org/TR/selectors-4/#attribute-case
     *
     * If [op] is `null`, this is always `null` as well.
     *
     * @var string
     */
    public $modifier;

    public function __construct($name)
    {
        $this->name = $name;
        $this->op = null;
        $this->value = null;
        $this->modifier = null;
    }

    /**
     * Creates an attribute selector that matches an element with a property
     * named [name], whose value matches [value] based on the semantics of [op].
     */
    public function withOperator($name, $op, $value, $args)
    {
        $args += [
            'modifier' => null,
        ];

        $this->name = $name;
        $this->op = $op;
        $this->value = $value;
        $this->modifier = $args['modifier'];
    }

    public function accept($visitor)
    {
        return $visitor->visitAttributeSelector($this);
    }

    public function __toString()
    {
        return __CLASS__ . '\0{$this->name}\0{$this->op}\0{$this->value}\0{$this->modifier}';
    }
}
