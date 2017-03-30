<?php

namespace Boosterpack\Contracts\Fantasy;

use Boosterpack\Contracts\Arrayable;
use Countable;

interface Foldable extends Countable, Arrayable
{
    /**
     * @param callable $predicate
     * @param mixed $initial
     * @return mixed
     */
    public function reduce(callable $predicate, $initial = null);

    /**
     * @param mixed $value
     * @return bool
     */
    public function contains($value);

    /**
     * @return bool
     */
    public function isEmpty();

    /**
     * @param callable $predicate
     * @return bool
     */
    public function any(callable $predicate);

    /**
     * @param callable $predicate
     * @return bool
     */
    public function all(callable $predicate);
}
