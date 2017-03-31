<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Maybe;
use Boosterpack\Contracts\Vector;

interface ShrinkableEnd
{
    /**
     * @return Maybe
     */
    public function last();

    /**
     * @param int $amount
     * @return static
     */
    public function dropEnd($amount);

    /**
     * @param int $amount
     * @return static
     */
    public function takeEnd($amount);

}

