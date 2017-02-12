<?php

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Fantasy\Monoid;
use Boosterpack\Contracts\Resizable\GrowableEnd;
use Boosterpack\Contracts\Resizable\ShrinkableStart;

interface Morphable extends ShrinkableStart, GrowableEnd, Monoid // Maybe swap GrowableEnd for GrowableStart
{
    public function morph(callable $callable);
}