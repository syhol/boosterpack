<?php

namespace Boosterpack\Contracts\Fantasy;

interface Monad extends Functor
{
    /**
     * @param callable $function
     * @return static
     */
    public function flatMap(callable $function);
}