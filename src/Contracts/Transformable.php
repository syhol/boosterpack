<?php

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Fantasy\Monoid;
use Boosterpack\Contracts\Resizable\GrowableEnd;
use Boosterpack\Contracts\Resizable\ShrinkableStart;

interface Transformable extends ShrinkableStart, GrowableEnd, Monoid
{
    public function transform(callable $callable);
}