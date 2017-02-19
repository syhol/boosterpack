<?php

namespace Boosterpack\Contracts\Indexed;

use Boosterpack\Contracts\Data\Maybe;

interface UniqueKeyIndex
{
    /**
     * @param mixed $index
     * @return Maybe
     */
    public function valueAt($index);
}