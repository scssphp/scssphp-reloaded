<?php

/**
 * @copyright 2018 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/selector/simple.dart@20978e03
 */

namespace Sass\Ast\Selector;

use Sass\Ast\AbstractSelector;
use Sass\Ast\Selector\PseudoSelector;
use Sass\Ast\Selector\UniversalSelector;
use Sass\Exception\SassScriptException;
use Sass\Parse\SelectorParser;

/**
 * An abstract superclass for simple selectors.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
abstract class AbstractSimpleSelector extends AbstractSelector
{
    /**
     * The minimum possible specificity that this selector can have.
     *
     * Pseudo selectors that contain selectors, like `:not()` and `:matches()`,
     * can have a range of possible specificities.
     *
     * Specifity is represented in base 1000. The spec says this should be
     * "sufficiently high"; it's extremely unlikely that any single selector
     * sequence will contain 1000 simple selectors.
     *
     * @return int
     */
    public function minSpecificity()
    {
        return 1000;
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
        return $this->minSpecificity();
    }

    /**
     * Parses a simple selector from [contents].
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
     * @return SimpleSelector
     */
    public static function parse($contents, $args)
    {
        $args += [
            'url' => null,
            'logger' => null,
            'allowParent' => true,
        ];

        return (new SelectorParser($contents, $args))->parseSimpleSelector();
    }

    /**
     * Returns a new [SimpleSelector] based on [this], as though it had been
     * written with [suffix] at the end.
     *
     * Assumes [suffix] is a valid identifier suffix. If this wouldn't produce a
     * valid [SimpleSelector], throws a [SassScriptException].
     *
     * @param string $suffix
     *
     * @return SimpleSelector
     *
     * @throws SassScriptException
     */
    public function addSuffix($suffix)
    {
        throw new SassScriptException('Invalid parent selector "$this"');
    }

    /**
     * Returns the compoments of a [CompoundSelector] that matches only elements
     * matched by both this and [compound].
     *
     * By default, this just returns a copy of [compound] with this selector
     * added to the end, or returns the original array if this selector already
     * exists in it.
     *
     * Returns `null` if unification is impossible—for example, if there are
     * multiple ID selectors.
     *
     * @param array $compound
     *
     * @return array
     */
    public function unify(array $compound)
    {
        if (count($compound) === 1 && ArrayUtils::first($compound) instanceof UniversalSelector) {
            return ArrayUtils::first($compound)->unify([$this]);
        }

        if (in_array($this, $compound])) {
            return $compound;
        }

        $result = [];
        $addedThis = false;

        foreach ($compound as $simple) {
            // Make sure pseudo selectors always come last.
            if (! $addedThis && $simple instanceof PseudoSelector) {
                $result[] = $this;

                $addedThis = true;
            }

            $result[] = $simple;
        }

        if (! $addedThis) {
            $result[] = $this;
        }

        return $result;
    }
}
