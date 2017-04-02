<?php

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Maybe;
use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Resizable\ShrinkableStart;
use Traversable;

interface Iterable extends Monad, Traversable
{
    /**
     * @return Maybe
     */
    public function first();

    /**
     * @param int $amount
     * @return static
     */
    public function drop($amount);

    /**
     * @param int $amount
     * @return static
     */
    public function take($amount);
}