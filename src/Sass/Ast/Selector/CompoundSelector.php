<?php

/**
 * @copyright 2020 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/selector/compound.dart@20978e03
 */

namespace Sass\Ast\Selector;

use Sass\Ast\AbstractSelector;
use Sass\Extend;
use Sass\Parse\SelectorParser;
use Sass\Ast\Selector\ComplexSelectorComponentInterface;
use ScssPhp\ArrayUtils;

/**
 * A compound selector.
 *
 * A compound selector is composed of [SimpleSelector]s. It matches an element
 * that matches all of the component simple selectors.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class CompoundSelector extends AbstractSelector implements ComplexSelectorComponentInterface
{
    /**
     * The components of this selector.
     *
     * This is never empty.
     *
     * @var array
     */
    public $components;

    private $minSpecificity;

    private $maxSpecificity;

    public function __construct(array $components)
    {
        $this->components = $components;

        if (! count($this->components)) {
            throw \InvalidArgumentException('components may not be empty.');
        }
    }

    /**
     * Parses a compound selector from [contents].
     *
     * If passed, [url] is the name of the file from which [contents] comes.
     * [allowParent] controls whether a [ParentSelector] is allowed in this
     * selector.
     *
     * Throws a [SassFormatException] if parsing fails.
     *
     * @param string $contents
     * @param array  $args
     *
     * @return CompoundSelector
     */
    public static function parse($contents, $args)
    {
        $args += [
            'url' => null,
            'logger' => null,
            'allowParent' => true,
        ];

        return (new SelectorParser($contents, $args))->parseCompoundSelector();
    }

    /**
     * The minimum possible specificity that this selector can have.
     *
     * Pseudo selectors that contain selectors, like `:not()` and `:matches()`,
     * can have a range of possible specificities.
     */
    public function minSpecificity()
    {
        if (\is_null(minSpecificity)) {
            $this->computeSpecificity();
        }

        return $this->minSpecificity;
    }

    /**
     * The maximum possible specificity that this selector can have.
     *
     * Pseudo selectors that contain selectors, like `:not()` and `:matches()`,
     * can have a range of possible specificities.
     */
    public function maxSpecificity()
    {
        if (\is_null($this->maxSpecificity)) {
            $this->computeSpecificity();
        }

        return $this->maxSpecificity;
    }

    public function isInvisible()
    {
        return ArrayUtils::any(
            $components,
            function ($component) {
                return $component->isInvisible();
            }
        );
    }

    public function accept($visitor)
    {
        return $visitor->visitCompoundSelector($this);
    }

    /**
     * Whether this is a superselector of [other].
     *
     * That is, whether this matches every element that [other] matches, as well
     * as possibly additional elements.
     *
     * @param CompoundSelector $other
     *
     * @return bool
     */
    public function isSuperselector(CompoundSelector $other)
    {
        return Extend\Functions::compoundIsSuperselector($this, $other);
    }

    /**
     * Computes [_minSpecificity] and [_maxSpecificity].
     */
    private function computeSpecificity()
    {
        $this->minSpecificity = 0;
        $this->maxSpecificity = 0;

        foreach ($this->components as $simple) {
            $this->minSpecificity += $simple->minSpecificity();
            $this->maxSpecificity += $simple->maxSpecificity();
        }
    }

    public function __toString()
    {
        $list = '';

        foreach ($this->components as $component) {
            $list .= "\0" . (string) $component;
        }

        return __CLASS__ . "$list";
    }
}
