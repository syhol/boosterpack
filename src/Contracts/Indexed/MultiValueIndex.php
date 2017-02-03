<?php

namespace Boosterpack\Contracts\Indexed;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Data\Vector;

interface MultiValueIndex
{
    /**
     * @param mixed $value
     * @return Maybe
     */
    public function findKeysOf($value);

    /**
     * @param callable $callable
     * @return Vector
     */
    public function findKeys(callable $callable);
}