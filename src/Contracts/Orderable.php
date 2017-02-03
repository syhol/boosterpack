<?php

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Fantasy\Setoid;

interface Orderable extends Setoid
{
    const GT = 1;
    const EQ = 0;
    const LT = -1;

    /**
     * @param Orderable|mixed $other
     * @return int
     */
    public function compare($other);
}