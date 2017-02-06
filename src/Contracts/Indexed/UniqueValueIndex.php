<?php

namespace Boosterpack\Contracts\Indexed;

use Boosterpack\Contracts\Data\Maybe;

interface UniqueValueIndex
{
    /**
     * @param mixed $value
     * @return Maybe
     */
    public function keyOf($value);

    /**
     * @param callable $callable
     * @return Maybe
     */
    public function findKey(callable $callable);
}