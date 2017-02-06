<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;

interface GrowableStart
{
    /**
     * @param mixed $item
     * @return static
     */
    public function shift($item);
}