<?php

namespace Boosterpack\Contracts\Fantasy;

interface Functor
{
    /**
     * @param callable $function
     * @return static
     */
    public function map(callable $function);
}
