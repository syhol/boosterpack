<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Fantasy\Monoid;
use Boosterpack\Contracts\Resizable\ShrinkableStart;
use Traversable;

interface InfiniteList extends Monoid, Monad, ShrinkableStart, Traversable
{

}