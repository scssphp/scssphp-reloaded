<?php

/**
 * @copyright 2018 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/ast/selector/simple.dart@20978e03
 */

namespace Sass\Ast\Selector;

/**
 * An operator that defines the semantics of an [AttributeSelector].
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class AttributeOperator
{
    /**
     * The operator's token text
     *
     * @var string
     */
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * The attribute value exactly equals the given value.
     *
     * @return AttributeOperator
     */
    public static function equal()
    {
        return new AttributeOperator('=');
    }

    /**
     * The attribute value is a whitespace-separated list of words, one of which
     * is the given value.
     *
     * @return AttributeOperator
     */
    public static function include()
    {
        return new AttributeOperator('~=');
    }

    /**
     * The attribute value is either exactly the given value, or starts with the
     * given value followed by a dash.
     *
     * @return AttributeOperator
     */
    public static function dash()
    {
        return new AttributeOperator('|=');
    }

    /**
     * The attribute value begins with the given value.
     *
     * @return AttributeOperator
     */
    public static function prefix()
    {
        return new AttributeOperator('^=');
    }

    /**
     * The attribute value ends with the given value.
     *
     * @return AttributeOperator
     */
    public static function suffix()
    {
        return new AttributeOperator('$=');
    }

    /**
     * The attribute value contains the given value.
     *
     * @return AttributeOperator
     */
    public static function substring()
    {
        return new AttributeOperator('*=');
    }

    public function toString()
    {
        return $this->text;
    }

    public function __toString()
    {
        return __CLASS__ . "\0{$this->text}";
    }
}
