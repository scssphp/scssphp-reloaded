<?php

/**
 * @copyright 2018 Anthon Pang
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace ScssPhp;

/**
 * Singleton
 */
trait SingletonTrait
{
    protected static $instance;

    // final private function __construct() { }

    final private function __clone()
    {
    }

    final public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
