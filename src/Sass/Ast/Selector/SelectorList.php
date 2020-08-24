<?php

/**
 * @copyright 2020 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/selector/list.dart@ec3d0ddc
 */

namespace Sass\Ast\Selector;

use Sass\Ast\AbstractSelector;
use Sass\Ast\Selector\ComplexSelector;
use Sass\Ast\Selector\CompoundSelector;
use Sass\Extend;
use Sass\Exception\SassScriptException;
use Sass\Parse\SelectorParser;
use Sass\Utils;
use Sass\Value\SassList;
use ScssPhp\ArrayUtils;

/**
 * A selector list.
 *
 * A selector list is composed of [ComplexSelector]s. It matches an element
 * that matches any of the component selectors.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class SelectorList extends AbstractSelector
{
    /**
     * The components of this selector.
     *
     * This is never empty.
     *
     * @var array
     */
    public $components;

    /**
     * SelectorList(Iterable<ComplexSelector> components)
     *
     * @param array $components
     */
    public function __construct(array $components)
    {
        $this->components = $components;

        if (! count($this->components)) {
            throw new \InvalidArgumentException('components may not be empty.');
        }
    }

    public function isInvisible()
    {
        return ArrayUtils::every(
            $components,
            function ($complex) {
                return $complex->isInvisible();
            }
        );
    }

    /**
     * Returns a SassScript list that represents this selector.
     *
     * This has the same format as a list returned by `selector-parse()`.
     *
     * @return SassList
     */
    public function asSassList()
    {
        return new SassList(
            \array_map(
                $components,
                function ($complex) {
                    return new SassList(
                        \array_map(
                            $complex->components,
                            function ($component) {
                                return new SassString($compoment->toString(), ['quotes' => false]);
                            }
                        ),
                        ListSeparator::space()
                    );
                }
            ),
            ListSeparator::comma()
        );
    }

    /**
     * Parses a selector list from [contents].
     *
     * If passed, [url] is the name of the file from which [contents] comes.
     * [allowParent] and [allowPlaceholder] control whether [ParentSelector]s or
     * [PlaceholderSelector]s are allowed in this selector, respectively.
     *
     * Throws a [SassFormatException] if parsing fails.
     *
     * @param string $contents
     * @param array  $args
     *
     * @return SelectorList
     */
    public static function parse($contents, $args)
    {
        $args += [
            'url' => null,
            'logger' => null,
            'allowParent' => true,
            'allowPlaceholder' => true,
        ];

        return (new SelectorParser($contents, $args))->parse();
    }

    public function accept($visitor)
    {
        return $visitor->visitSelectorList($this);
    }

    /**
     * Returns a [SelectorList] that matches only elements that are matched by
     * both this and [other].
     *
     * If no such list can be produced, returns `null`.
     *
     * @param SelectorList $other
     *
     * @return SelectorList
     */
    public function unify(SelectorList $other)
    {
        $contents = ArrayUtils::expand(
            $this->components,
            function ($complex1) {
                return ArrayUtils::expand(
                    $other->components,
                    function ($complex2) use ($complex1) {
                        $unified = Extend\Functions::unifyComplex([$complex1->components, $complex2->components]);

                        if (\is_null(unified)) {
                            return [];
                        }

                        return \array_map(
                            $unified,
                            function ($complex) {
                                new ComplexSelector($complex);
                            }
                        );
                    }
                );
            }
        );

        return ! count($contents) ? null : new SelectorList($contents);
    }

    /**
     * Returns a new list with all [ParentSelector]s replaced with [parent].
     *
     * If [implicitParent] is true, this treats [ComplexSelector]s that don't
     * contain an explicit [ParentSelector] as though they began with one.
     *
     * The given [parent] may be `null`, indicating that this has no parents. If
     * so, this list is returned as-is if it doesn't contain any explicit
     * [ParentSelector]s. If it does, this throws a [SassScriptException].
     *
     * @param SelectorList $parent
     * @param array        $args
     *
     * @return SelectorList
     */
    public function resolveParentSelectors(SelectorList $parent, $args)
    {
        $args += [
            'implicitParent' => true,
        ];

        if (\is_null($parent)) {
            if (! $this->containsParentSelector()) {
                return $this;
            }

            throw new SassScriptException(
                'Top-level selectors may not contain the parent selector "&".'
            );
        }

        return new SelectorList(
            Utils::flattenVertically(
                \array_map(
                    $components,
                    function ($complex) use ($parent, $args) {
                        if (! $this->complexContainsParentSelector($complex)) {
                            if (! $args['implicitParent']) {
                                return [$complex];
                            }

                            return \array_map(
                                $parent->components,
                                function ($parentComplex) {
                                    return new ComplexSelector(
                                        \array_merge($parentComplex->components, $complex->components),
                                        ['lineBreak' => $complex->lineBreak || $parentComplex->lineBreak]
                                    );
                                }
                            );
                        }

                        $newComplexes = [[]];
                        $lineBreaks = [false];

                        foreach ($complex->components as $component) {
                            if ($component instanceof CompoundSelector) {
                                $resolved = $this->resolveParentSelectorsCompound($component, $parent);

                                if (\is_null($resolved)) {
                                    foreach ($newComplexes as $newComplex) {
                                        $newComplex[] = $component;
                                    }

                                    continue;
                                }

                                $previousComplexes = $newComplexes;
                                $previousLineBreaks = $lineBreaks;
                                $newComplexes = [];
                                $lineBreaks = [];
                                $i = 0;

                                foreach ($previousComplexes as $newComplex) {
                                    $lineBreak = $previousLineBreaks[$i++];

                                    foreach ($resolved as $resolvedComplex) {
                                        $newComplexes[] = \array_merge(
                                            $newComplex,
                                            $resolvedComplex->components
                                        );
                                        $lineBreaks[] = $lineBreak || $resolvedComplex->lineBreak;
                                    }
                                }
                            } else {
                                foreach ($newComplexes as $newComplex) {
                                    $newComplex[] = $component;
                                }
                            }
                        }

                        $i = 0;

                        return \array_map(
                            $newComplexes,
                            function ($newComplex) use (&$i, $lineBreaks) {
                                return new ComplexSelector(
                                    $newComplex,
                                    ['lineBreak' => $lineBreaks[$i++]]
                                );
                            }
                        );
                    }
                )
            )
        );
    }

    /**
     * Returns whether [complex] contains a [ParentSelector].
     *
     * @param ComplexSelector $complex
     *
     * @return bool
     */
    private function complexContainsParentSelector(ComplexSelector $complex)
    {
        return ArrayUtils::any(
            $complex->components,
            function ($component) {
                return $component instanceof CompoundSelector &&
                    ArrayUtils::any(
                        $component->components,
                        function ($simple) {
                            return $simple instanceof ParentSelector ||
                                ($simple instanceof PseudoSelector &&
                                $simple->selector !== null &&
                                $simple->selector->containsParentSelector());
                        }
                    );
            }
        );
    }

    /**
     * Returns a new [CompoundSelector] based on [compound] with all
     * [ParentSelector]s replaced with [parent].
     *
     * Returns `null` if [compound] doesn't contain any [ParentSelector]s.
     *
     * @param CompoundSelector $compound
     * @param SelectorList     $parent
     *
     * @return array
     */
    private function resolveParentSelectorsCompound(CompoundSelector $compound, SelectorList $parent)
    {
        $containsSelectorPseudo = ArrayUtils::any(
            $compound->components,
            function ($simple) {
                return $simple instanceof PseudoSelector &&
                    $simple->selector !== null &&
                    $simple->selector->containsParentSelector();
            }
        );

        if (
            ! $containsSelectorPseudo &&
            ! ArrayUtils::first($compound->components) instanceof ParentSelector
        ) {
            return null;
        }

        $resolvedMembers = $containsSelectorPseudo
            ? \array_map(
                $compound->components,
                function ($simple) {
                    if ($simple instanceof PseudoSelector) {
                        if (\is_null($simple->selector)) {
                            return $simple;
                        }

                        if (! $simple->selector->containsParentSelector()) {
                            return $simple;
                        }

                        return $simple->withSelector(
                            $simple->selector
                                   ->resolveParentSelectors($parent, ['implicitParent' => false])
                        );
                    } else {
                        return $simple;
                    }
                }
            )
            : $compound->components;

        $parentSelector = ArrayUtils::first($compound->components);

        if ($parentSelector instanceof ParentSelector) {
            if (count($compound->components) === 1 && \is_null($parentSelector->suffix)) {
                return $parent->components;
            }
        } else {
            return [
                new ComplexSelector([new CompoundSelector($resolvedMembers)])
            ];
        }

        return \array_map(
            $parent->components,
            function ($complex) {
                $lastComponent = ArrayUtils::last($complex->components);

                if (! $lastComponent instanceof CompoundSelector) {
                    throw new SassScriptException(
                        "Parent \"$complex\" is incompatible with this selector."
                    );
                }

                $last = $lastComponent instanceof CompoundSelector;
                $suffix = ArrayUtils::first($compound->components)->suffix;

                if ($suffix !== null) {
                    $last = new CompoundSelector(
                        \array_merge(
                            ArrayUtils::take($last->components, -1),
                            [ArrayUtils::last($last->components)->addSuffix($suffix)],
                            ArrayUtils::skip($resolvedMembers, 1)
                        )
                    );
                } else {
                    $last =
                        new CompoundSelector(\array_merge(
                            $last->components,
                            ArrayUtils::skip($resolvedMembers, 1)
                        ));
                }

                return new ComplexSelector(
                    \array_merge(
                        ArrayUtils::take($complex->components, -1),
                        $last
                    ),
                    ['lineBreak' => $complex->lineBreak]
                );
            }
        );
    }

    /**
     * Whether this contains a [ParentSelector].
     *
     * @return bool
     */
    private function containsParentSelector()
    {
        return ArrayUtils::any(
            $components,
            function ($component) {
                return $component->complexContainsParentSelector();
            }
        );
    }

    /**
     * Whether this is a superselector of [other].
     *
     * That is, whether this matches every element that [other] matches, as well
     * as possibly additional elements.
     *
     * @param SelectorList $other
     *
     * @return bool
     */
    public function isSuperselector(SelectorList $other)
    {
        return Extend\Functions::listIsSuperslector($components, $other->components);
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
