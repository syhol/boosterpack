<?php

namespace Boosterpack\Contracts\Fantasy;

use Countable;

interface Foldable extends Countable
{
    /**
     * @param callable $function
     * @param mixed $initial
     * @return mixed
     */
    public function reduce(callable $function, $initial);
}
