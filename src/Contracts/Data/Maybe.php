<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Fantasy\Comonad;
use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Arrayable;

interface Maybe extends Monad, Comonad, Arrayable
{
    public function orValue($default);
    public function orElse(callable $callable);
}