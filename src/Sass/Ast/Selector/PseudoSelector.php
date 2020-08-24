<?php

/**
 * @copyright 2020 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/selector/pseudo.dart@ec3d0ddc
 */

namespace Sass\Ast\Selector;

use Sass\Ast\Select\SelectorList;
use Sass\Ast\Select\SimpleSelector;
use Sass\Ast\Utils;
use Sass\Visitor\Interfaces\Selector;

/**
 * A pseudo-class or pseudo-element selector.
 *
 * The semantics of a specific pseudo selector depends on its name. Some
 * selectors take arguments, including other selectors. Sass manually encodes
 * logic for each pseudo selector that takes a selector as an argument, to
 * ensure that extension and other selector operations work properly.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class PseudoSelector extends SimpleSelector
{
    /**
     * The name of this selector.
     *
     * @var string
     */
    public $name;

    /**
     * Like [name], but without any vendor prefixes.
     *
     * @var string
     */
    public $normalizedName;

    /**
     * Whether this is a pseudo-class selector.
     *
     * This is `true` if and only if [isElement] is `false`.
     *
     * @var bool
     */
    public $isClass;

    /**
     * Whether this is a pseudo-element selector.
     *
     * This is `true` if and only if [isClass] is `false`.
     *
     * @return bool
     */
    public function isElement()
    {
        return ! $this->isClass;
    }

    /**
     * Whether this is syntactically a pseudo-class selector.
     *
     * This is the same as [isClass] unless this selector is a pseudo-element
     * that was written syntactically as a pseudo-class (`:before`, `:after`,
     * `:first-line`, or `:first-letter`).
     *
     * This is `true` if and only if [isSyntacticElement] is `false`.
     *
     * @var bool
     */
    public $isSyntacticClass;

    /**
     * Whether this is syntactically a pseudo-element selector.
     *
     * This is `true` if and only if [isSyntacticClass] is `false`.
     *
     * @return bool
     */
    public function isSyntacticElement()
    {
        return ! $this->isSyntacticClass;
    }

    /**
     * The non-selector argument passed to this selector.
     *
     * This is `null` if there's no argument. If [argument] and [selector] are
     * both non-`null`, the selector follows the argument.
     *
     * @var string
     */
    public $argument;

    /**
     * The selector argument passed to this selector.
     *
     * This is `null` if there's no selector. If [argument] and [selector] are
     * both non-`null`, the selector follows the argument.
     *
     * @var SelectorList
     */
    public $selector;

    private $minSpecificity;

    private $maxSpecificity;

    /**
     * @param string $name
     * @param array  $args
     */
    public function __construct($name, $args)
    {
        $args += [
            'element' => false,
            'argument' => null,
            'selector' => null,
        ];

        $this->name = $name;
        $this->element = $args['element'];
        $this->argument = $args['argument'];
        $this->selector = $args['selector'];

        $this->isClass = ! $this->element && ! $this->isFakePseudoElement($name);
        $this->isSyntacticClass = ! $this->element;
        $this->normalizedName = Utils::unvendor($name);
    }

    public function minSpecificity()
    {
        if (\is_null($this->minSpecificity)) {
            $this->computeSpecificity();
        }

        return $this->minSpecificity;
    }

    public function maxSpecificity()
    {
        if (\is_null($this->maxSpecificity)) {
            $this->computeSpecificity();
        }

        return $this->maxSpecificity;
    }

    public function isInvisible()
    {
        if (\is_null($this->selector)) {
            return false;
        }

        // We don't consider `:not(%foo)` to be invisible because, semantically, it
        // means "doesn't match this selector that matches nothing", so it's
        // equivalent to *. If the entire compound selector is composed of `:not`s
        // with invisible lists, the serialier emits it as `*`.
        return $this->name !== 'not' && $this->selector->isInvisible();
    }

    /**
     * Returns whether [name] is the name of a pseudo-element that can be written
     * with pseudo-class syntax (`:before`, `:after`, `:first-line`, or
     * `:first-letter`)
     *
     * @param string $name
     *
     * @return bool
     */
    private function isFakePseudoElement($name)
    {
        switch ($name[0]) {
            case 'a':
            case 'A':
                return Utils::equalsIgnoreCase($name, 'after');

            case 'b':
            case 'B':
                return Utils::equalsIgnoreCase($name, 'before');

            case 'f':
            case 'F':
                return Utils::equalsIgnoreCase($name, 'first-line') ||
                       Utils::equalsIgnoreCase($name, 'first-letter');

            default:
                return false;
        }
    }

    /**
     * Returns a new [PseudoSelector] based on this, but with the selector
     * replaced with [selector].
     *
     * @param SelectorList $selector
     *
     * @return PseudoSelector
     */
    public function withSelector(SelectorList $selector)
    {
        return new PseudoSelector(
            $this->name,
            [
                'element' => $this->isElement(),
                'argument' => $this->argument,
                'selector' => $this->selector
            ]
        );
    }

    /**
     * @param string $suffix
     *
     * @return PseudoSelector
     */
    public function addSuffix($suffix)
    {
        if ($this->argument !== null || $this->selector !== null) {
            parent::addSuffix($suffix); // note: parent throws an exception
        }

        return new PseudoSelector($this->name . $suffix, ['element' => $this->isElement()]);
    }

    /**
     * @param array $compound
     *
     * @return array
     */
    public function unify(array $compound)
    {
        if (count($compound) === 1 && ArrayUtils::first($compound) instanceof UniversalSelector) {
            return ArrayUtils::first($compound)->unify([$this]);
        }

        if (in_array($this, $compound)) {
            return $compound;
        }

        $result = [];
        $addedThis = false;

        foreach ($compound as $simple) {
            if ($simple instanceof PseudoSelector && $simple->isElement()) {
                // A given compound selector may only contain one pseudo element. If
                // [compound] has a different one than [this], unification fails.
                if ($this->isElement()) {
                    return null;
                }

                // Otherwise, this is a pseudo selector and should come before pseduo
                // elements.
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

    /**
     * Computes [_minSpecificity] and [_maxSpecificity].
     */
    private function computeSpecificity()
    {
        if ($this->isElement) {
            $this->minSpecificity = 1;
            $this->maxSpecificity = 1;

            return;
        }

        if (\is_null($this->selector)) {
            $this->minSpecificity = parent::minSpecificity();
            $this->maxSpecificity = parent::maxSpecificity();

            return;
        }

        if ($this->name === 'not') {
            $this->minSpecificity = 0;
            $this->maxSpecificity = 0;

            foreach ($this->selector->components as $complex) {
                $this->minSpecificity = max($this->minSpecificity, $complex->minSpecificity());
                $this->maxSpecificity = max($this->maxSpecificity, $complex->maxSpecificity());
            }
        } else {
            // This is higher than any selector's specificity can actually be.
            $this->minSpecificity = pow(parent::minSpecificity(), 3);
            $this->maxSpecificity = 0;

            foreach ($this->selector->components as $complex) {
                $this->minSpecificity = min($this->minSpecificity, $complex->minSpecificity());
                $this->maxSpecificity = max($this->maxSpecificity, $complex->maxSpecificity());
            }
        }
    }

    public function accept($visitor)
    {
        return $visitor->visitPseudoSelector($this);
    }

    public function __toString()
    {
        return __CLASS__ . "\0{$this->name}\0{$this->isClass}\0{$this->argument}\0{$this->selector}";
    }
}
