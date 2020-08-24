<?php

/**
 * @copyright 2020 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/selector/complex.dart@20978e03
 */

namespace Sass\Ast\Selector;

use Sass\Ast\AbstractSelector;
use Sass\Functions;
use Sass\Utils;
use ScssPhp\ArrayUtils;

/**
 * A complex selector.
 *
 * A complex selector is composed of [CompoundSelector]s separated by
 * [Combinator]s. It selects elements based on their parent selectors.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class ComplexSelector extends AbstractSelector
{
    /**
     * @var int
     */
    private $minSpecificity;

    /**
     * @var int
     */
    private $maxSpecificity;

    /**
     * @var bool
     */
    private $isInvisible;

    /**
     * The components of this selector.
     *
     * This is never empty.
     *
     * Descendant combinators aren't explicitly represented here. If two
     * [CompoundSelector]s are adjacent to one another, there's an implicit
     * descendant combinator between them.
     *
     * It's possible for multiple [Combinator]s to be adjacent to one another.
     * This isn't valid CSS, but Sass supports it for CSS hack purposes.
     *
     * @var array
     */
    public $components;

    /**
     * Whether a line break should be emitted *before* this selector.
     *
     * @var bool
     */
    public $lineBreak;

    public function __construct(array $components, $args)
    {
        $args += [
            'lineBreak' => false,
        ];

        $this->components = $components;
        $this->lineBreak = $args['lineBreak'];

        if (! count($this->components)) {
            throw new \InvalidArgumentException('components may not be empty.');
        }
    }

    /**
     * The minimum possible specificity that this selector can have.
     *
     * Pseudo selectors that contain selectors, like `:not()` and `:matches()`,
     * can have a range of possible specificities.
     *
     * @return int
     */
    public function minSpecificity()
    {
        if (\is_null($this->minSpecificity)) {
            $this->computeSpecificity();
        }

        return $this->minSpecificity;
    }

    /**
     * The maximum possible specificity that this selector can have.
     *
     * Pseudo selectors that contain selectors, like `:not()` and `:matches()`,
     * can have a range of possible specificities.
     *
     * @return int
     */
    public function maxSpecificity()
    {
        if (\is_null($this->maxSpecificity)) {
            $this->computeSpecificity();
        }

        return $this->maxSpecificity;
    }

    /**
     * @return bool
     */
    public function isInvisible()
    {
        if ($this->isInvisible !== null) {
            return $this->isInvisible;
        }

        $this->isInvisible = ArrayUtils::any(
            $components,
            function ($component) {
                return $component instanceof CompoundSelector && $component->isInvisible();
            }
        );

        return $this->isInvisible;
    }

    public function accept($visitor)
    {
        return $visitor->visitComplexSelector($this);
    }

    /**
     * Whether this is a superselector of [other].
     *
     * That is, whether this matches every element that [other] matches, as well
     * as possibly matching more.
     *
     * @param ComplexSelector $other
     *
     * @return bool
     */
    public function isSuperselector(ComplexSelector $other)
    {
        return Functions::complexIsSuperselector($components, $other->components);
    }

    /**
     * Computes [_minSpecificity] and [_maxSpecificity].
     */
    private function computeSpecificity()
    {
        $this->minSpecificity = 0;
        $this->maxSpecificity = 0;

        foreach ($components as $component) {
            if ($component instanceof CompoundSelector) {
                $this->minSpecificity += $component->minSpecificity();
                $this->maxSpecificity += $component->maxSpecificity();
            }
        }
    }

    public function __toString()
    {
        $list = '';

        foreach ($this->components as $component) {
            $list .= "\0" . (string) $component;
        }

        return __CLASS__ . $list;
    }
}
