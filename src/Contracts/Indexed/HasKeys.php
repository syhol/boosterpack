<?php

namespace Boosterpack\Contracts\Indexed;

use Boosterpack\Contracts\Data\Vector;

interface HasKeys
{
    /**
     * @return Vector
     */
    public function keys();

    /**
     * @param mixed $value
     * @return boolean
     */
    public function hasKey($value);
}