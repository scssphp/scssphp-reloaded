<?php
/**
 * @copyright 2017 Google Inc.
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass.git
 * @see lib/src/logger.dart@487e5025
 */
namespace Sass\Logger;

use DartLang\SourceSpan\SourceSpan;
use Sass\Logger;

/**
 * A logger that emits no messages.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class QuietLogger extends Logger
{
    /**
     * @inheritDoc
     */
    public function warn($message, $args)
    {
    }

    /**
     * @inheritDoc
     */
    public function debug($message, SourceSpan $span)
    {
    }
}
