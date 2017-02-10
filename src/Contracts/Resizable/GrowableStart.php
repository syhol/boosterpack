<?php

namespace Boosterpack\Contracts\Resizable;

interface GrowableStart
{
    /**
     * @param mixed $item
     * @return static
     */
    public function unshift($item);
}