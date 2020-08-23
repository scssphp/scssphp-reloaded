<?php

/**
 * @copyright 2020 Anthon Pang
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace ScssPhp;

/**
 * Array utility functions
 *
 * @author Anthon Pang <apang@softwaredevelopment.ca>
 */
class ArrayUtils
{
    /**
     * Checks whether any element of this iterable satisfies test.
     *
     * Checks every element in iteration order, and returns true if any of them
     * make test return true, otherwise returns false.
     *
     * @param array    $array
     * @param callable $callback
     *
     * @return bool
     *
     * @internal Based on dart-core Iterable::any()
     */
    public static function any(array $array, /*callback*/ $callback)
    {
        foreach ($array as $element) {
            if (call_user_func($callback, $element)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Expands each element of this Iterable into zero or more elements.
     *
     * The resulting Iterable runs through the elements returned by f for each
     * element of this, in iteration order.
     *
     * The returned Iterable is lazy, and calls f for each element of this
     * every time it's iterated.
     *
     * @param array    $array
     * @param callable $callback
     *
     * @return array
     */
    public static function expand(array $array, /*callable*/ $callback)
    {
        $flattened = [];

        foreach ($array as $element) {
            $expanded = call_user_func($callback, $element);

            $flattened = array_merge($flattened, $expanded);
        }

        return $flattened;
    }
}
