<?php

namespace Boosterpack\Contracts\Indexed;

use Boosterpack\Contracts\Data\Vector;

interface NonUniqueValueIndex
{
    /**
     * @param mixed $value
     * @return Vector
     */
    public function keysOf($value);

    /**
     * @param callable $callable
     * @return Vector
     */
    public function findKeys(callable $callable);
}