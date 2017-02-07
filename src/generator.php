<?php
use Boosterpack\Contracts\Data\InfiniteList;

/**
 * @param callable $callable
 * @param mixed $initial
 * @return InfiniteList
 */
function iterate(callable $callable, $initial)
{

}

/**
 * @param callable $predicate
 * @param callable $transform
 * @param mixed $initial
 * @return InfiniteList
 */
function until(callable $predicate, callable $transform, $initial)
{

}

/**
 * @param mixed $item
 * @return InfiniteList
 */
function repeat($item)
{

}

/**
 * @param \Traversable $items
 * @return InfiniteList
 */
function cycle($items)
{

}
