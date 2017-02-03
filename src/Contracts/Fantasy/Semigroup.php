<?php

namespace Boosterpack\Contracts\Fantasy;

interface Semigroup
{
    /**
     * @param mixed $value
     * @return static
     */
    public function concat($value);
}
