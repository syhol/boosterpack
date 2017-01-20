<?php

namespace Boosterpack\Contracts\Fantasy;

interface Semigroup
{
    /**
     * @param Semigroup $value
     *
     * @return Semigroup
     */
    public function concat(Semigroup $value);
}
