<?php

/**
 * Interface Set
 *
 * Does not make any assumptions that the structure is sorted, indexed, unique, finite, nested
 */
interface Set extends Arrayable
{
    public function map(callable $callable);
    public function filter(callable $callable);
    public function partition(callable $callable);
    public function reduce(callable $callable, $initial = null);
    public function any(callable $callable);
    public function all(callable $callable);
    public function find(callable $callable);
    public function contains($item);
    public function containsAll($items);
    public function containsAny($items);
    public function countValues($value);
    public function remove($value);
    public function removeAll($value);
    public function clear();
    public function isEmpty();
}