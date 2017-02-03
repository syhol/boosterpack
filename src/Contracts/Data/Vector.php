<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Resizable\Resizable;
use Boosterpack\Contracts\Indexed\MultiValueIndex;
use Boosterpack\Contracts\Indexed\Pairable;
use Boosterpack\Contracts\Indexed\UniqueKeyIndex;

interface Vector extends
    StandardCollection,
    MultiValueIndex,
    UniqueKeyIndex,
    Pairable,
    Resizable
{

}