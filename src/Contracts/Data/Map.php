<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Indexed\MultiValueIndex;
use Boosterpack\Contracts\Indexed\Pairable;
use Boosterpack\Contracts\Indexed\UniqueKeyIndex;
use Boosterpack\Contracts\Indexed\WritableIndex;

interface Map extends
    StandardCollection,
    MultiValueIndex,
    UniqueKeyIndex,
    Pairable,
    WritableIndex
{

}