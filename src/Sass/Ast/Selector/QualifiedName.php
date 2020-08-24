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
 * A [qualified name][].
 *
 * [qualified name]: https://www.w3.org/TR/css3-namespace/#css-qnames
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class QualifiedName
{
    /**
     * The identifier name.
     *
     * @var string
     */
    public $name;

    /**
     * The namespace name.
     *
     * If this is `null`, [name] belongs to the default namespace. If it's the
     * empty string, [name] belongs to no namespace. If it's `*`, [name] belongs
     * to any namespace. Otherwise, [name] belongs to the given namespace.
     *
     * @var string
     */
    public $namespace;

    public function __construct($name, $args)
    {
        $args += [
            'namespace' => null,
        ];

        $this->name = $name;
        $this->namespace = $args['namespace'];
    }

    public function toString()
    {
        return \is_null($this->namespace) ? $this->name : "{$this->namespace}|{$this->name}";
    }

    public function __toString()
    {
        return __CLASS__ . "\0{$this->name}\0{$this->namespace}";
    }
}
