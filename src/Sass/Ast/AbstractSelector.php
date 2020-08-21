<?php

/**
 * @copyright 2018 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/node.dart@f1c23e74
 */

namespace Sass\Ast;

use DartLang\SourceSpan\FileSpan;
use Sass\Ast\FakeAstNode;
use Sass\Visitor\Serialize;

/**
 * A node in the abstract syntax tree for a selector.
 *
 * This selector tree is mostly plain CSS, but also may contain a
 * [ParentSelector] or a [PlaceholderSelector].
 *
 * Selectors have structural equality semantics.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
abstract class AbstractSelector
{
    /**
     * Whether this selector, and complex selectors containing it, should not be
     * emitted.
     *
     * @var bool
     */
    protected $isInvisible = false;

    public function getIsInvisible()
    {
        return $this->isInvisible;
    }

    /**
     * Calls the appropriate visit method on [visitor].
     *
     * @param SelectorVisitor $visitor
     *
     * @return mixed
     */
    abstract public function accept(SelectorVisitor $visitor);
   
    public function toString()
    {
        return serializeSelector($this, ['inspect' => true]);
    }
}
