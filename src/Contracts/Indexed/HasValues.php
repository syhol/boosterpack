<?php

namespace Boosterpack\Contracts\Indexed;

use Boosterpack\Contracts\Data\Vector;

interface HasValues
{
    /**
     * @return Vector
     */
    public function values();

    /**
     * @param mixed $value
     * @return boolean
     */
    public function hasValue($value);
}