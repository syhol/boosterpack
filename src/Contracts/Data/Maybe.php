<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Arrayable;
use Boosterpack\Maybe\Just;

interface Maybe extends Monad, Arrayable
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