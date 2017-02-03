<?php

namespace Boosterpack\Contracts\Fantasy;

interface Functor
{
    /**
     * @param callable $function
     * @return self
     */
    public function map(callable $function);
}
