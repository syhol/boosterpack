<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 03/02/17
 * Time: 17:11
 */

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Indexed\MappableIndex;
use Boosterpack\Contracts\Fantasy\Foldable;
use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Fantasy\Setoid;
use Boosterpack\Contracts\Reversible;
use Boosterpack\Contracts\Sortable;
use Traversable;

interface StandardCollection extends
    Reversible,
    Setoid,
    Foldable,
    Monad,
    Traversable,
    MappableIndex
{

}