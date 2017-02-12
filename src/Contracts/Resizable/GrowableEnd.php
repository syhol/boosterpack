<?php

namespace Boosterpack\Contracts\Resizable;

interface GrowableEnd
{
    /**
     * @param mixed $item
     * @return self
     */
    public function push($item);
}