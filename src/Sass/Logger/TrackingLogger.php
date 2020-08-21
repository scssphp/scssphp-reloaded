<?php

/**
 * @copyright 2017 Google Inc.
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass.git
 * @see lib/src/logger/tracking.dart@487e5025
 */

namespace Sass\Logger;

use DartLang\SourceSpan\SourceSpan;
use DartLang\StackTrace\StackTrace;
use Sass\AbstractLogger;

/**
 * A logger that wraps another logger and keeps track of when it is used.
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class TrackingLogger extends AbstractLogger
{
    /**
     * @var AbstractLogger
     */
    protected $logger;

    /**
     * Whether [warn] has been called on this logger.
     *
     * @var bool
     */
    protected $emittedWarning;

    /**
     * Whether [debug] has been called on this logger.
     *
     * @var bool
     */
    protected $emittedDebug;

    /**
     * @inheritDoc
     */
    public function warn($message, $args)
    {
        $args += [
            'span' => null,
            'trace' => null,
            'deprecation' => false,
        ];

        $this->emittedWarning = true;
        $this->logger->warn($message, $args);
    }

    /**
     * @inheritDoc
     */
    public function debug($message, SourceSpan $span)
    {
        $this->emittedDebug = true;
        $this->logger->debug($message, $span);
    }

    /**
     * @return bool
     */
    public function getEmittedWarning()
    {
        return $this->emittedWarning;
    }

    /**
     * @return bool
     */
    public function getEmittedDebug()
    {
        return $this->emittedDebug;
    }
}
