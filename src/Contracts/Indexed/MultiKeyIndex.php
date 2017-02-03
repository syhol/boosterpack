<?php

namespace Boosterpack\Contracts\Indexed;

use Boosterpack\Contracts\Data\Vector;

interface MultiKeyIndex
{
    /**
     * @param mixed $index
     * @return Vector
     */
    public function elementsAt($index);
}