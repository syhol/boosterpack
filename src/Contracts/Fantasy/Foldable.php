<?php

interface Foldable extends Countable
{
    /**
     * @param callable $function
     * @param $initial
     *
     * @return mixed
     */
    public function reduce(callable $function, $initial);
    public function filter(callable $function);
    public function partition(callable $function);
    public function any(callable $callable);
    public function all(callable $callable);
    public function find(callable $callable); // See https://hackage.haskell.org/package/base-4.9.1.0/docs/Data-List.html#v:find
    public function isEmpty();
}
