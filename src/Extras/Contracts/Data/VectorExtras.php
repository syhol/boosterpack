<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 03/02/17
 * Time: 00:30
 */

namespace Boosterpack\Extras\Contracts\Data;


interface VectorExtras
{
    // Functions or extras
    public function insert($index, $item); // Push everything to the right +!
    public function append($item); // alias of GrowableStart
    public function prepend($item); // alias of GrowableEnd
    public function drop($condition); // ShrinkableStart
    public function take($condition); // ShrinkableStart
    public function startsWith($vector); // ShrinkableStart
    public function endsWith($vector);  // ShrinkableEnd
    public function ensureStart($vector); // ResizableStart
    public function ensureEnd($vector); // ResizableEnd
    public function removeStart($vector); // ResizableStart
    public function removeEnd($vector); // ResizableEnd
    public function longestCommonPrefix($vector); // ShrinkableStart
    public function longestCommonSuffix($vector); // ?
    public function longestCommonSubset($vector); // ShrinkableEnd
    public function pad($vector); // Growable
    public function padStart($vector); // GrowableStart
    public function padEnd($vector); // GrowableEnd
    public function trim($vector); // Shrinkable
    public function trimStart($vector); // ShrinkableStart
    public function trimEnd($vector); // ShrinkableEnd

    public function replaceSubset($subset1, $subset2);
    public function countSubsets($subset);
    public function slice($start, $length);
    public function removeSlice($start, $length);
    public function splice($vector, $start, $length = 0);
    public function chunk($size = null); // ShrinkableStart

    public function join($glue = '');
    public function unique();
    public function subsets(); // All orders subsequent
    public function subsequences(); // Same order, all possible lengths, may not be subsequent
    public function permutations(); // Same length,  all possible different orders
    public function intersperse($value); // Insert a new value in between each existing value
    public function intersect($vector);
    public function difference($vector);
    public function inits(); // ShrinkableEnd
    public function tails(); // ShrinkableStart

    // Move out into subclass'

    public function flatten($level = null); // Monad extra

    public function random(); // Sortable & Foldable extra
    public function reverse(); // Sortable extra (i think?)
    public function shuffle(); // Sortable extra
}