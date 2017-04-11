<?php

namespace Boosterpack\Iterator;

use Boosterpack\RewindableGenerator;
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
function exponential($start = 1, $exponent = 1.2, $end = INF)
{
    yield $start;
    foreach (range($start) as $base) {
        $result = pow($base, $exponent);
        if ($result > $end) {
            return;
        }
        yield $result;
    }
}

/**
 * @param $value
 * @param $times
 * @return \Generator
 */
function repeat($value, $times = INF)
{
    if ($times === INF) {
        while (true) {
            yield $value;
        }
    } else {
        $i = 0;
        while ($i++ < $times) {
            yield $value;
        }
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

}

/**
 * @param array|Traversable $keys
 * @param array|Traversable $values
 * @return \Generator
 */
function unpairs($keys, $values)
{

}

/**
 * @param array|Traversable $items
 * @return \Generator
 */
function pairs($items)
{

}

/**
 * @param array[]|Traversable[] ...$items
 */
function chain(...$items)
{

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


function keys($items)
{

}

function values($items)
{

}

function flatten($items)
{

}

function flattenAll($items)
{

}

function flatMap($iterable, $predicate)
{

}

function flip($iterable)
{

}

function chunk($count, $items)
{

}

function window($count, $items)
{

}

//
// Reducers
//


/**
 * @param callable $function
 * @param $items
 * @param null $initial
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

function nth($index, $items)
{

}

function any(callable $predicate, $items)
{

}

function all(callable $predicate, $items)
{

}

function search(callable $predicate, $items)
{

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

function join($separator, $items)
{

}

function contains($value, $items)
{

}

function count($items)
{

}

function min($items)
{

}

function mix($items)
{

}

function product($items)
{

}

function sum($items)
{

}

function average($items)
{

}
