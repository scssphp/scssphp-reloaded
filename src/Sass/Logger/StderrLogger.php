<?php

/**
 * @copyright 2018 Google Inc.
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link https://github.com/sass/dart-sass.git
 * @see lib/src/logger/stderr.dart@487e5025
 */

namespace Sass\Logger;

use DartLang\Path\Path;
use DartLang\SourceSpan\SourceSpan;
use Sass\AbstractLogger;
use Sass\Utils;

/**
 * A logger that emits to standard error
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class StderrLogger extends AbstractLogger
{
    /**
     * Whether to use terminal colors in messages.
     *
     * @var bool
     */
    private $color;

    /**
     * Creates a logger that prints warnings to standard error, with terminal
     * colors if [color] is `true` (default `false`).
     *
     * @param bool $color
     */
    public function __construct($color = false)
    {
        $this->color = false;
    }

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

        if ($this->color) {
            // Bold yellow.
            \fwrite(STDERR, "\x00\x1b[33m\x00\x1b[1m'");

            if ($args['deprecation']) {
                \fwrite(STDERR, 'Deprecation ');
            }

            \fwrite(STDERR, "Warning\x00\x1b[0m");
        } else {
            if ($args['deprecation']) {
                \fwrite(STDERR, 'Deprecation ');
            }

            \fwrite(STDERR, 'WARNING');
        }

        if (\is_null($args['span'])) {
            \fwrite(STDERR, ": $message\n");
        } elseif (! \is_null($args['trace'])) {
            // If there's a span and a trace, the span's location information is
            // probably duplicated in the trace, so we just use it for highlighting.
            \fwrite(STDERR, ": $message\n\n" . $args['span']->highlight(['color' => $this->color]) . "\n");
        } else {
            \fwrite(STDERR, ' on ' . $args['span']->message("\n" . $message, ['color' => $this->color]) . "\n");
        }

        if (! \is_null($args['trace'])) {
            \fwrite(STDERR, Utils::indent(\rtrim((string) $args['trace']), 4) . "\n");
        }

        \fwrite(STDERR, "\n");
    }

    /**
     * @inheritDoc
     */
    public function debug($message, SourceSpan $span)
    {
        $url = \is_null($span->start->sourceUrl) ? '-' : Path::prettyUri($span->start->sourceUrl);

        \fwrite(STDERR, "$url:" . ($span->start->line + 1) . ' ');
        \fwrite(STDERR, $this->color ? "\x00\x1b[1mDebug\x00\x1b[0m" : 'DEBUG');
        \fwrite(STDERR, ": $message\n");
    }
}
