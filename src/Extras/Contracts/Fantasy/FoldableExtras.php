<?php

namespace Boosterpack\Extras\Contracts\Fantasy;

use Boosterpack\Contracts\Fantasy\Foldable;

interface FoldableExtras extends Foldable
{

    public function first($condition = null); // Foldable extra
    public function last($condition = null); // Foldable extra

    public function partition(callable $function);
    public function any(callable $callable);
    public function all(callable $callable);
    public function contains($item);
    public function isEmpty();

    public function product();
    public function sum();
    public function maximum();
    public function minimum();
    public function average();
}
