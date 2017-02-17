<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Fantasy\Monoid;
use Boosterpack\Contracts\Resizable\ResizableStart;
use Traversable;

interface InfiniteList extends Monoid, Monad, ResizableStart, Traversable
{

}