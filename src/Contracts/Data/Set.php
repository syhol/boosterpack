<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Indexed\UniqueValueIndex;
use Boosterpack\Contracts\Indexed\Pairable;
use Boosterpack\Contracts\Indexed\UniqueKeyIndex;

interface Set extends
    StandardCollection,
    UniqueValueIndex,
    UniqueKeyIndex,
    Pairable,
    Resizable
{

}