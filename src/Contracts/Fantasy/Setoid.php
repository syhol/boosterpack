<?php

namespace Boosterpack\Contracts\Fantasy;

interface Setoid
{
    /**
     * @param mixed $other
     * @return bool
     */
    public function equals($other);
}