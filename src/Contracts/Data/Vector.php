<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Resizable\Resizable;
use Boosterpack\Contracts\Indexed\NonUniqueValueIndex;
use Boosterpack\Contracts\Indexed\Pairable;
use Boosterpack\Contracts\Indexed\UniqueKeyIndex;
use Boosterpack\Contracts\Fantasy\Comonad;

interface Vector extends
    StandardCollection,
    NonUniqueValueIndex,
    UniqueKeyIndex,
    Pairable,
    Resizable,
    Comonad
{

}