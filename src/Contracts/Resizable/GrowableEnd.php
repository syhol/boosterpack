<?php

namespace Boosterpack\Contracts\Resizable;

interface GrowableEnd
{
    /**
     * @param mixed $item
     * @return static
     */
    public function push($item);
}