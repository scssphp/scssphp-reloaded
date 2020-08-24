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
        foreach ($array as &$element) {
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

    /**
     * Returns the first element.
     *
     * Throws a StateError if this is empty. Otherwise returns the first element
     * in the iteration order, equivalent to this.elementAt(0).
     *
     * @return mixed
     *
     * @throws \OutOfRangeException
     */
    public static function first(array $array)
    {
        if (! count($array)) {
            throw new \OutOfRangeException('no first element');
        }

        return $array[0];
    }

    /**
     * Returns the last element.
     *
     * Throws a StateError if this is empty. Otherwise may iterate through the
     * elements and returns the last one seen. Some iterables may have more
     * efficient ways to find the last element (for example a list can directly
     * access the last element, without iterating through the previous ones).
     *
     * @return mixed
     *
     * @throws \OutOfRangeException
     */
    public static function last(array $array)
    {
        $last = count($array) - 1;

        if ($last < 0) {
            throw new \OutOfRangeException('no last element');
        }

        return $array[$last];
    }

    /**
     * Removes and returns the first element of this queue.
     *
     * The queue must not be empty when this method is called.
     *
     * @param array $array
     *
     * @return mixed
     */
    public static function removeFirst(array &$array)
    {
        if (! count($array)) {
            throw new \InvalidArgumentException('no first element');
        }

        $result = \array_shift($array);

        return $result;
    }

    /**
     * Returns an Iterable that provides all but the first count elements.
     *
     * When the returned iterable is iterated, it starts iterating over this,
     * first skipping past the initial count elements. If this has fewer than
     * count elements, then the resulting Iterable is empty. After that, the
     * remaining elements are iterated in the same order as in this iterable.
     *
     * Some iterables may be able to find later elements without first iterating
     * through earlier elements, for example when iterating a List. Such
     * iterables are allowed to ignore the initial skipped elements.
     *
     * The count must not be negative.
     *
     * @param array $array
     * @param int   $count
     *
     * @return array
     */
    public static function skip(array $array, $count)
    {
        return array_slice($array, $count);
    }

    /**
     * Returns a lazy iterable of the count first elements of this iterable.
     *
     * The returned Iterable may contain fewer than count elements, if this
     * contains fewer than count elements.
     *
     * The elements can be computed by stepping through iterator until count
     * elements have been seen.
     *
     * The count must not be negative.
     *
     * @param array $array
     * @param int   $count
     *
     * @return array
     */
    public static function take(array $array, $count)
    {
        return array_slice($array, 0, $count);
    }
}
