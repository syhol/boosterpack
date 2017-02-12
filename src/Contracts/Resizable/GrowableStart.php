<?php

namespace Boosterpack\Contracts\Resizable;

interface GrowableStart
{
    /**
     * @param mixed $item
     * @return self
     */
    public function unshift($item);
}