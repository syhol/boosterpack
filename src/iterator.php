<?php

namespace Boosterpack\Iterator;

use ArrayIterator;
use function Boosterpack\method;
use Boosterpack\RewindableGenerator;
use Countable;
use IteratorAggregate;
use Traversable;

//
// Helpers
//

/**
 * @param $value
 * @return bool
 */
function isIterable($value)
{
    return is_array($value) || $value instanceof Traversable;
}

/**
 * @param $value
 * @param $what
 */
function assertIterable($value)
{
    if (!isIterable($value)) {
        throw new \InvalidArgumentException("Parameter must be iterable");
    }
}

/**
 * @param callable $function
 * @param array $arguments
 * @return RewindableGenerator
 */
function generate(callable $function, $arguments = [])
{
    new RewindableGenerator($function, $arguments);
}

/**
 * @param $value
 * @return Traversable
 */
function toIterator($value)
{
    assertIterable($value);
    if (is_array($value)) {
        return new ArrayIterator($value);
    } elseif ($value instanceof IteratorAggregate) {
        return $value->getIterator();
    } elseif ($value instanceof Traversable) {
        return $value;
    }
}

/**
 * @param $value
 * @return array
 */
function toArray($value)
{
    assertIterable($value);
    if (is_array($value)) {
        return $value;
    } elseif ($value instanceof Traversable) {
        return iterator_to_array($value);
    }
}

//
// Constructors
//

/**
 * @return \Generator
 */
function unit($value)
{
    yield $value;
}

/**
 * @return \Generator
 */
function getEmpty()
{
    return new \Generator();
}

/**
 * @param int $start
 * @param int $end
 * @param int $step
 * @return \Generator
 */
function range($start = 1, $end = INF, $step = 1)
{
    while ($start <= $end) {
        yield $start;
        $start += $step;
    }
}

/**
 * @param int|float $start
 * @param int|float $exponent
 * @param number $end
 * @return \Generator
 */
function exponential($start = 1, $exponent = 1.2)
{
    yield $start;
    foreach (range($start) as $base) {
        $result = pow($base, $exponent);
        yield $result;
    }
}

/**
 * @param $value
 * @param $times
 * @return \Generator
 */
function repeat($value)
{
    while (true) {
        yield $value;
    }
}

/**
 * @param array|Traversable $items
 * @return \Generator
 */
function cycle($items)
{
    assertIterable($items);

    while (true) {
        foreach ($items as $item) {
            yield $item;
        }
    }

}

/**
 * @param callable $predicate
 * @param callable $transform
 * @param mixed $initial
 * @return \Generator
 */
function until(callable $predicate, callable $transform, $initial = null)
{
    while ($predicate($initial)) {
        yield $initial = $transform($initial);
    }
}

/**
 * @param callable $callable
 * @param $initial
 * @return \Generator
 */
function iterate(callable $callable, $initial)
{
    while (true) {
        yield $initial = $callable($initial);
    }
}

//
// Transformers
//

/**
 * @param callable $callable
 * @param array|Traversable $items
 * @return \Generator
 */
function map(callable $callable, $items)
{
    assertIterable($items);
    foreach ($items as $key => $item) {
        yield $key => $callable($item, $key);
    }
}

/**
 * @param callable $callable
 * @param array|Traversable $items
 * @return \Generator
 */
function mapKeys(callable $callable, $items)
{
    assertIterable($items);
    foreach ($items as $key => $item) {
        yield $callable($key, $item) => $item;
    }
}

/**
 * @param callable $callable
 * @param array|Traversable $items
 * @return \Generator
 */
function reindex(callable $callable, $items)
{
    assertIterable($items);
    foreach ($items as $key => $item) {
        yield $callable($item, $key) => $item;
    }
}

/**
 * @param callable $callable
 * @param array|Traversable $items
 * @return \Generator
 */
function filter(callable $callable, $items)
{
    assertIterable($items);
    foreach ($items as $key => $item) {
        if ($callable($item, $key)) {
            yield $key => $item;
        }
    }
}

/**
 * @param callable $callable
 * @param array|Traversable $items
 * @param mixed $initial
 * @return \Generator
 */
function reductions(callable $callable, $items, $initial = null)
{
    assertIterable($items);
    foreach ($items as $key => $value) {
        yield $initial = $callable($initial, $value, $key);
    }
}

/**
 * @param array|Traversable ...$items
 * @return \Generator
 */
function zip(...$items)
{
    $items = map('Boosterpack\\Iterator\\toIterator', $items);
    map(method('reset'), $items);
    while (true) {
        if (!all(method('valid'), $items)) {
            break;
        }
        yield map(method('current'), $items);
        map(method('next'), $items);
    }
}

require 'general.php';
require 'Generator.php';
require 'function.php';

var_dump(toArray(zip([1,2], ['a', 'b'])));

/**
 * @param array|Traversable $keys
 * @param array|Traversable $values
 * @return \Generator
 */
function unpairs($keys, $values)
{
    // Need iter
}

/**
 * @param array|Traversable $items
 * @return \Generator
 */
function pairs($items)
{
    assertIterable($items);
    foreach ($items as $key => $value) {
        yield [$key, $value];
    }
}

/**
 * @param array[]|Traversable[] ...$items
 * @return \Generator
 */
function chain(...$items)
{
    assertIterable($items);
    foreach ($items as $item) {
        assertIterable($item);
        foreach ($item as $key => $value) {
            yield $key => $value;
        }
    }
}

function cartesianProduct(...$items)
{

}

function slice($start, $length)
{

}

function take($count, $items)
{

}

function drop($count, $items)
{

}

function skip($count, $items)
{

}

function takeWhile(callable $predicate, $items)
{

}

function dropWhile(callable $predicate, $items)
{

}

/**
 * @param array|Traversable $items
 * @return \Generator
 */
function keys($items)
{
    assertIterable($items);
    foreach ($items as $key => $value) {
        yield $key;
    }
}

/**
 * @param array|Traversable $items
 * @return \Generator
 */
function values($items)
{
    assertIterable($items);
    foreach ($items as $value) {
        yield $value;
    }
}

/**
 * @param array|Traversable $items
 * @return \Generator
 */
function flatten($items)
{
    assertIterable($items);
    foreach ($items as $item) {
        if (isIterable($item)) {
            foreach ($item as $subItem) {
                yield $subItem;
            }
        } else {
            yield $item;
        }
    }
}

/**
 * @param array|Traversable $items
 * @return \Generator
 */
function flattenAll($items)
{
    assertIterable($items);
    foreach ($items as $item) {
        if (isIterable($item)) {
            foreach (flattenAll($item) as $subItem) {
                yield $subItem;
            }
        } else {
            yield $item;
        }
    }
}

/**
 * @param callable $callable
 * @param array|Traversable $items
 * @return \Generator
 */
function flatMap(callable $callable, $items)
{
    assertIterable($items);
    foreach ($items as $item) {
        $result = $callable($item);
        foreach ($result as $key => $value) {
            yield $key => $value;
        }
    }
}

/**
 * @param array|Traversable $items
 */
function flip($items)
{

}

/**
 * @param $count
 * @param array|Traversable $items
 * @return \Generator
 */
function chunk($count, $items)
{
    assertIterable($items);
    $chunks = [];
    $index = 0;
    foreach ($items as $value) {
        $chunks[] = $value;
        if (++$index >= $count) {
            yield $chunks;
            $chunks = [];
            $index = 0;
        }
    }
}

/**
 * @param $count
 * @param array|Traversable $items
 * @return \Generator
 */
function window($count, $items)
{
    assertIterable($items);
    $window = [];
    $index = 0;
    foreach ($items as $value) {
        $window[] = $value;
        if (++$index >= $count) {
            yield $window;
            array_shift($window);
        }
    }
}

//
// Reducers
//


/**
 * @param callable $function
 * @param array|Traversable $items
 * @param mixed $initial
 * @return mixed
 */
function reduce(callable $function, $items, $initial = null)
{
    assertIterable($items);
    foreach ($items as $key => $value) {
        $initial = $function($initial, $value, $key);
    }
    return $initial;
}

/**
 * @param integer $index
 * @param array|Traversable $items
 * @return null|mixed
 */
function nth($index, $items)
{
    assertIterable($items);
    $current = 0;
    foreach ($items as $value) {
        if ($current++ === $index) {
            return $value;
        }
    }
    return null;
}

/**
 * @param callable $predicate
 * @param array|Traversable $items
 * @return bool
 */
function any(callable $predicate, $items)
{
    assertIterable($items);
    foreach ($items as $value) {
        if ($predicate($value)) {
            return true;
        }
    }
    return false;
}

/**
 * @param callable $predicate
 * @param array|Traversable $items
 * @return bool
 */
function all(callable $predicate, $items)
{
    assertIterable($items);
    foreach ($items as $value) {
        if (!$predicate($value)) {
            return false;
        }
    }
    return true;
}

/**
 * @param callable $predicate
 * @param array|Traversable $items
 * @return bool
 */
function search(callable $predicate, $items)
{
    assertIterable($items);
    foreach ($items as $value) {
        if ($predicate($value)) {
            return $value;
        }
    }
    return true;
}

/**
 * @param callable $callable
 * @param array|Traversable $items
 */
function apply(callable $callable, $items)
{
    assertIterable($items);
    foreach ($items as $key => $item) {
        $callable($item, $key);
    }
}

/**
 * @param string $separator
 * @param array|Traversable $items
 * @return string
 */
function join($separator, $items)
{
    assertIterable($items);
    $string = '';
    foreach ($items as $item) {
        $string .= $item;
    }
    return $string;
}

/**
 * @param mixed $value
 * @param array|Traversable $items
 * @return bool
 */
function contains($value, $items)
{
    assertIterable($items);
    foreach ($items as $item) {
        if ($value === $item) {
            return true;
        }
    }
    return false;
}

/**
 * @param array|Traversable $items
 * @return int|null
 */
function count($items)
{
    if (is_string($items)) {
        return mb_strlen($items);
    }
    if (is_array($items) || $items instanceof Countable) {
        return \count($items);
    }
    if ($items instanceof Traversable) {
        return iterator_count($items);
    }
    return null;
}

/**
 * @param array|Traversable $items
 * @return mixed
 */
function min($items)
{
    assertIterable($items);
    $min = INF;
    foreach ($items as $item) {
        $min = $min > $item ? $item : $min;
    }
    return $min;
}

/**
 * @param array|Traversable $items
 * @return mixed
 */
function max($items)
{
    assertIterable($items);
    $max = 0;
    foreach ($items as $item) {
        $max = $max < $item ? $item : $max;
    }
    return $max;
}

/**
 * @param array|Traversable $items
 * @return int|mixed
 */
function product($items)
{
    assertIterable($items);
    $product = 0;
    foreach ($items as $item) {
        $product *= $item;
    }
    return $product;
}

/**
 * @param array|Traversable $items
 * @return mixed
 */
function sum($items)
{
    assertIterable($items);
    $sum = INF;
    foreach ($items as $item) {
        $sum += $item;
    }
    return $sum;
}

/**
 * @param array|Traversable $items
 * @return float|int
 */
function average($items)
{
    assertIterable($items);
    $average = INF;
    foreach ($items as $item) {
        $average += $item;
    }
    return $average / count($items);
}
