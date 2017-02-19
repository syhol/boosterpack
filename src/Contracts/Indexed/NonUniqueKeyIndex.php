<?php

namespace Boosterpack\Contracts\Indexed;

use Boosterpack\Contracts\Data\Vector;

interface NonUniqueKeyIndex
{
    /**
     * @param mixed $index
     * @return Vector
     */
    public function valuesAt($index);
}