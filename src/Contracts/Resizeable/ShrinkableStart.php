<?php

namespace Boosterpack\Contracts\Resizable;

interface ShrinkableStart
{
    /**
     * @param mixed $item
     * @return static
     */
    public function shift($item);
}