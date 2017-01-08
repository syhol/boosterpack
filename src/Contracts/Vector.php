<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 07/01/17
 * Time: 17:59
 */
interface Vector extends Set, Countable, Indexed, NumberContainer, Sortable, Traversable
{
    public function append($vector); // vector or item? Ideal is vector for string and item for vector
    public function prepend($vector); // vector or item? Ideal is vector for string and item for vector
    public function surround($vector); // vector or item? Ideal is vector for string and item for vector
    public function concat($vector);
    public function first($condition = null);
    public function last($condition = null);
    public function drop($condition);
    public function take($condition);
    public function startsWith($vector);
    public function endsWith($vector);
    public function ensureStart($vector);
    public function ensureEnd($vector);
    public function removeStart($vector);
    public function removeEnd($vector);
    public function longestCommonPrefix($vector);
    public function longestCommonSuffix($vector);
    public function longestCommonSubset($vector);
    public function pad($vector);
    public function padStart($vector);
    public function padEnd($vector);
    public function trim($vector);
    public function trimStart($vector);
    public function trimEnd($vector);
    public function repeatTimes($count);
    public function cycleUntil($count);
    public function replaceSubset($subset1, $subset2);
    public function reverse();
    public function random();
    public function shuffle();
    public function countSubsets($subset);
    public function slice($start, $length = null);
    public function splice($vector, $start, $length = 0);
    public function chunk($size = null);
    public function flatten($level = null);
    public function intersperse($value);
    public function subsets();
    public function unique();
    public function intersection($vector);
    public function permutations();
    public function difference($vector);
    public static function times(callable $callable, $size);
    public static function iterate(callable $callable, $initial);
    public static function until(callable $predicate, callable $transform, $initial);
    public static function repeat($item);
    public static function cycle($vector);

}