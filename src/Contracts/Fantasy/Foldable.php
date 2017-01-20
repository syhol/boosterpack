<?php

namespace Boosterpack\Contracts\Fantasy;

use Countable;

interface Foldable extends Countable
{
    /**
     * @param callable $function
     * @param $initial
     *
     * @return mixed
     */
    public function reduce(callable $function, $initial);

    public function find(callable $callable);
    public function filter(callable $function);
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
