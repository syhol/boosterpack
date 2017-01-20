<?php

namespace Boosterpack\Contracts\Fantasy;

interface Comonad extends Functor
{
    public function extract();
}