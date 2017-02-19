<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Indexed\NonUniqueValueIndex;
use Boosterpack\Contracts\Indexed\Pairable;
use Boosterpack\Contracts\Indexed\UniqueKeyIndex;
use Boosterpack\Contracts\Indexed\WritableIndex;

interface Map extends
    StandardCollection,
    NonUniqueValueIndex,
    UniqueKeyIndex,
    Pairable,
    WritableIndex
{

}