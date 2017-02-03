<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;

interface GrowableStart
{
    /**
     * @return Maybe[]|static[] [Maybe, static]
     */
    public function unshift();
}