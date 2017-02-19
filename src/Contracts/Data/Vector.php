<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Resizable\Resizable;
use Boosterpack\Contracts\Indexed\NonUniqueValueIndex;
use Boosterpack\Contracts\Indexed\Pairable;
use Boosterpack\Contracts\Indexed\UniqueKeyIndex;

interface Vector extends
    StandardCollection,
    NonUniqueValueIndex,
    UniqueKeyIndex,
    Pairable,
    Resizable
{

}