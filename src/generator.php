<?php

namespace Boosterpack;

use Boosterpack\Contracts\Data\InfiniteList;
use Boosterpack\Data\Generator;

/**
 * @param callable $callable
 * @param mixed $initial
 * @return InfiniteList
 */
function iterate(callable $callable, $initial)
{
    return new Generator(function() use ($callable, $initial) {
        while (true) {
            yield $initial = $callable($initial);
        }
    });
}

/**
 * @param callable $predicate
 * @param callable $transform
 * @param mixed $initial
 * @return InfiniteList
 */
function until(callable $predicate, callable $transform, $initial)
{
    return new Generator(function() use ($predicate, $transform, $initial) {
        while ($predicate($initial)) {
            yield $initial = $transform($initial);
        }
    });
}

/**
 * @param mixed $item
 * @return InfiniteList
 */
function repeat($item)
{
    return new Generator(function() use ($item) {
        yield $item;
    });
}

/**
 * @param \Traversable $items
 * @return InfiniteList
 */
function cycle($items)
{
    return new Generator(function() use ($items) {
        while (true) {
            foreach ($items as $item) {
                yield $item;
            }
        }
    });
}

/**
 * @param callable $generatorFactory
 * @return Generator
 */
function memorizeGenerator(callable $generatorFactory)
{
    return new Generator(function() use ($generatorFactory) {
        static $cache = [];
        static $generator = null;
        foreach ($cache as $item) {
            yield $item;
        }
        if (is_null($generator)) {
            $generator = $generatorFactory() ;
            if ($generator->valid()) {
                yield $cache[] = $generator->current();
            }
        }
        while ($generator->valid()) {
            $generator->next();
            yield $cache[] = $generator->current();
        }
    });
}
