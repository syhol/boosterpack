<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Arrayable;
use Boosterpack\Contracts\Fantasy\Setoid;
use Boosterpack\Maybe\Just;
use Boosterpack\Contracts\Fantasy\Comonad;

interface Maybe extends Monad, Setoid, Arrayable, Comonad
{
    /**
     * @param mixed $default
     * @return Just
     */
    public function orValue($default);

    /**
     * @param callable $callable
     * @return Just
     */
    public function orElse(callable $callable);
}