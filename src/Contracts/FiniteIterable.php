<?php

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Maybe;
use Boosterpack\Contracts\Fantasy\Foldable;
use Boosterpack\Contracts\Resizable\ShrinkableEnd;

interface FiniteIterable extends Iterable, Foldable
{
    /**
     * @return Maybe
     */
    public function last();

    /**
     * @param int $amount
     * @return static
     */
    public function dropEnd($amount);

    /**
     * @param int $amount
     * @return static
     */
    public function takeEnd($amount);
}