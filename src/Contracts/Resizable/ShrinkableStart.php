<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Maybe;
use Boosterpack\Contracts\Vector;

interface ShrinkableStart
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