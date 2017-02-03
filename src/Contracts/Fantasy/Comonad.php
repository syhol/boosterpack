<?php

namespace Boosterpack\Contracts\Fantasy;

interface Comonad extends Functor
{
    /**
     * @return mixed
     */
    public function extract();
}