<?php

namespace Boosterpack\Contracts\Fantasy;

use Traversable;

interface Functor extends Traversable
{
    /**
     * @param callable $function
     *
     * @return self
     */
    public function map(callable $function);
}
