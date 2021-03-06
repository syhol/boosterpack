<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Indexed\MappableIndex;
use Boosterpack\Contracts\Fantasy\Foldable;
use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Fantasy\Setoid;
use Boosterpack\Contracts\Arrayable;
use Boosterpack\Contracts\Reversible;
use Boosterpack\Contracts\Sortable;
use JsonSerializable;
use Traversable;

interface StandardCollection extends
    Sortable,
    Reversible,
    Setoid,
    Foldable,
    Monad,
    JsonSerializable,
    Arrayable,
    Traversable,
    MappableIndex
{

}