<?php

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Fantasy\Monoid;
use Boosterpack\Contracts\Resizable\ResizableEnd;

interface Reversible extends Monoid, ResizableEnd
{
    /**
     * @return static
     */
    public function reverse();
}