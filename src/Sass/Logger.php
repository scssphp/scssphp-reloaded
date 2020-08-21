<?php
/**
 * @copyright 2017 Google Inc.
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass.git
 * @see lib/src/logger.dart@487e5025
 */
namespace Sass;

use ScssPhp\SourceSpan\SourceSpan;

/**
 * An interface for loggers that print messages produced by Sass stylesheets.
 *
 * This may be implemented by user code.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
abstract class Logger
{
    /**
     * Emits a warning with the given [message].
     *
     * If [span] is passed, it's the location in the Sass source that generated
     * the warning. If [trace] is passed, it's the Sass stack trace when the
     * warning was issued. If [deprecation] is `true`, it indicates that this is
     * a deprecation warning. Implementations should surface all this information
     * to the end user.
     *
     * @param string $message
     * @param array  $args
     */
    abstract public function warn($message, $args);

    /**
     * Emits a debugging message associated with the given [span].
     *
     * @param string     $message
     * @param SourceSpan $span
     */
    abstract public function debug($message, SourceSpan $span);
}
