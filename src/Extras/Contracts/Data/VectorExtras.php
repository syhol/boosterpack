<?php

namespace Boosterpack\Extras\Contracts\Data;

interface VectorExtras
{
    // STABILIZEDish
    public function startsWith($items); // ShrinkableStart
    public function endsWith($items);  // ShrinkableEnd
    public function ensureStart($items); // ResizableStart
    public function ensureEnd($items); // ResizableEnd
    public function removeStart($items); // ShrinkableStart
    public function removeEnd($items); // ShrinkableEnd
    public function pad($items); // Growable
    public function padStart($items); // GrowableStart
    public function padEnd($items); // GrowableEnd
    public function trim($items); // Shrinkable
    public function trimStart($items); // ShrinkableStart
    public function trimEnd($items); // ShrinkableEnd

    public function splitAt($condition); // Morphable                                     // Maybe infinite
    public function span($condition); // Morphable                                        // ...
    public function replaceSubset($subset1, $subset2); // Morphable
    public function slice($start, $length); // Morphable
    public function removeSlice($start, $length); // Morphable
    public function splice($items, $start, $length = 0); // Morphable
    public function chunk($size = null); // Morphable
    public function unique(); // Morphable
    public function subsets(); // Morphable             // All orders subsequent
    public function subsequences(); // Morphable        // Same order, all possible lengths, may not be subsequent
    public function permutations(); // Morphable        // Same length,  all possible different orders
    public function intersperse($item); // Morphable    // Insert a new value in between each existing value
    public function intersect($items); // Morphable
    public function difference($items); // Morphable
    public function group(); // Morphable

    // UNSTABLE
    public function insert($index, $item); // Push everything to the right +!

    public function countSubsets($subset); // ShrinkableStart  // Never infinite ?
    public function inits(); // ShrinkableEnd                  // Never infinite ?
    public function tails(); // ShrinkableStart                // Never infinite ?

    public function longestCommonPrefix($items); // ? ShrinkableStart
    public function longestCommonSubset($items); // ? I DONT EVEN!!!!
    public function longestCommonSuffix($items); // ? ShrinkableEnd

    public function flatten($level = null); // Monad extra
    public function join($glue = ''); // Foldable

    public function random(); // Sortable|Foldable extra
    public function reverse(); // Sortable
    public function shuffle(); // Sortable
}
