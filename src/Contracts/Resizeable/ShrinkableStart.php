<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;

interface ShrinkableStart
{
    /**
     * @return Maybe[]|static[] [Maybe, static]
     */
    public function shift();
}