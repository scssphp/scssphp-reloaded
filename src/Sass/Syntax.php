<?php

/**
 * @copyright 2018 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass
 * @see lib/src/syntax.dart@149bf85b
 */

namespace Sass;

use DartLang\Path\Path;

/**
 * An enum of syntaxes that Sass can parse.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class Syntax
{
    // The CSS-superset SCSS syntax.
    const SCSS = 'SCSS';

    // The whitespace-sensitive indented syntax.
    const SASS = 'Sass';

    // The plain CSS syntax, which disallows special Sass features.
    const CSS = 'CSS';

    /**
     * Returns the default syntax to use for a file loaded from [path].
     *
     * @param string $path
     *
     * @return string
     */
    public static function forPath($path)
    {
        switch (Path::extension($path)) {
            case '.sass':
                return self::SASS;

            case '.css':
                return self::CSS;

            default:
                return self::SCSS;
        }
    }
}
