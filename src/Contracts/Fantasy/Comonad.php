<?php

namespace Boosterpack\Contracts\Fantasy;

interface Comonad extends Functor
{
    /**
     * @return mixed
     */
    public function extract();

    /**
     * @param callable $extender
     * @return Comonad
     */
    public function extend(callable $extender);
}