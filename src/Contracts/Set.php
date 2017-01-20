<?php

/**
 * Interface Set
 *
 * Does not make any assumptions that the structure is sorted, indexed, unique, finite, nested
 */
interface Set extends Arrayable, Monad, Monoid, Setoid, Foldable
{
    public function contains($item);
    public function containsAll($items);
    public function containsAny($items);
    public function countValues($value);
    public function remove($value);
    public function removeAll($value);
}