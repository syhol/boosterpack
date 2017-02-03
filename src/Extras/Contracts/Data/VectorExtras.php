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
    public function insert($index, $item);    // Push everything to the right +!
    public function append($item);
    public function prepend($item);
    public function init();
    public function tail();
    public function inits();
    public function tails();
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

    public function replaceSubset($subset1, $subset2);
    public function countSubsets($subset);
    public function slice($start, $length);
    public function removeSlice($start, $length);
    public function splice($vector, $start, $length = 0);
    public function chunk($size = null);

    public function join($glue = '');
    public function unique();
    public function subsets(); // All orders subsequent
    public function subsequences(); // Same order, all possible lengths, may not be subsequent
    public function permutations(); // Same length,  all possible different orders
    public function intersperse($value); // Insert a new value in between each existing value
    public function intersect($vector);
    public function difference($vector);

    // Move out into subclass'

    public function flatten($level = null); // Monad extra

    public function random(); // Sortable & Foldable extra
    public function reverse(); // Sortable extra (i think?)
    public function shuffle(); // Sortable extra
}