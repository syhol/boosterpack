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

    public function drop($condition); // Transformable                                        // Maybe infinite
    public function take($condition); // Transformable (Maybe this is just a ShrinkableStart) // Never infinite
    public function splitAt($condition); // Transformable                                     // Maybe infinite
    public function span($condition); // Transformable                                        // ...
    public function replaceSubset($subset1, $subset2); // Transformable
    public function slice($start, $length); // Transformable
    public function removeSlice($start, $length); // Transformable
    public function splice($items, $start, $length = 0); // Transformable
    public function chunk($size = null); // Transformable
    public function unique(); // Transformable
    public function subsets(); // Transformable             // All orders subsequent
    public function subsequences(); // Transformable        // Same order, all possible lengths, may not be subsequent
    public function permutations(); // Transformable        // Same length,  all possible different orders
    public function intersperse($item); // Transformable    // Insert a new value in between each existing value
    public function intersect($items); // Transformable
    public function difference($items); // Transformable
    public function group(); // Transformable

    // UNSTABLE
    public function insert($index, $item); // Push everything to the right +!

    public function countSubsets($subset); // ShrinkableStart  // Never infinite ?
    public function inits(); // ShrinkableEnd                  // Never infinite ?
    public function tails(); // ShrinkableStart                // Never infinite ?

    public function longestCommonPrefix($items); // ? ShrinkableStart
    public function longestCommonSubset($items); // ? I DONT EVEN!!!!
    public function longestCommonSuffix($items); // ? ShrinkableEnd

    public function dropEnd($condition); // ? TransformableEnd
    public function takeEnd($condition); // ? TransformableEnd

    public function flatten($level = null); // Monad extra
    public function join($glue = ''); // Foldable

    public function random(); // Sortable|Foldable extra
    public function reverse(); // Sortable
    public function shuffle(); // Sortable
}
