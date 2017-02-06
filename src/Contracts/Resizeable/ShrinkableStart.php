<?php

namespace Boosterpack\Contracts\Resizable;

interface ShrinkableStart
{
    /**
     * @return Maybe[]|static[] [Maybe, static]
     */
    public function unshift();
}