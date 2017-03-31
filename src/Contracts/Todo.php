<?php

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Data\Maybe;

interface Todo
{
    public function isEmpty();

    // Sorted
    public function sort();
    public function reverse();
    public function shuffle();

    public function random();

    // Multiple of the Value
    public function unique();

    public function splitAt($index);

    public function splitWhere(callable $predicate);

    public function chunks($size);

    public function windows($size);

    public function subsets();

    public function countSubsets($subset);

    public function replaceSubset($subset1, $subset2);

    public function subsequences();

    public function permutations();

    public function intersperse($item);

    public function intersect($items);

    public function difference($items);

    public function group();

    public function insert($index, $item); // Push everything to the right +! Very vector

    public function push($item); // Add to end

    public function unshift($item); // Add to begining

    public function inits(); // ShrinkableEnd                  // Never infinite ?

    public function tails(); // ShrinkableStart                // Never infinite ?

    public function flatten($level = null); // Monad extra

    public function startsWith($items); // ShrinkableStart

    public function endsWith($items);  // ShrinkableEnd

    public function ensureStart($items); // ??

    public function ensureEnd($items); // ??

    public function removeStart($items); // ShrinkableStart

    public function removeEnd($items); // ShrinkableEnd

    public function pad($items); // ??

    public function padStart($items); // ??

    public function padEnd($items); // ??

    public function trim($items); // Shrinkable

    public function trimStart($items); // ShrinkableStart

    public function trimEnd($items); // ShrinkableEnd

    public function longestCommonPrefix($items); // ShrinkableStart

    public function longestCommonSubset($items); // FiniteIterable

    public function longestCommonSuffix($items); // ShrinkableEnd

    public function span($condition); // Morphable

    public function slice($start, $length); // Drop and Take aka Shrinkable Start

    public function removeSlice($start, $length);

    public function splice($items, $start, $length = 0); // Morphable

    public function removeAt($index);
    public function hasKey($index);
    public function firstKeyOf($value);
    public function lastKeyOf($value);
    public function findFirstKey(callable $callable);
    public function findLastKey(callable $callable);
}