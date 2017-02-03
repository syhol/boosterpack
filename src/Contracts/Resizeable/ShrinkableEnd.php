<?php

namespace Boosterpack\Contracts\Resizable;

interface ShrinkableEnd
{
    /**
     * @return Maybe[]|static[] [Maybe, static]
     */
    public function pop();
}