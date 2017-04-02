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
}
