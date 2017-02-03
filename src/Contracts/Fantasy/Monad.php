<?php

namespace Boosterpack\Contracts\Fantasy;

interface Monad extends Functor
{
    /**
     * @param callable $function
     * @return static
     */
    public function bind(callable $function);
}