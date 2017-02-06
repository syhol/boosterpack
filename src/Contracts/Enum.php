<?php

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Resizable\ShrinkableStart;

interface Enum
{
    /**
     * @return static
     */
    public function succ();

    /**
     * @return static
     */
    public function pred();

    /**
     * @param mixed $from
     * @param mixed $to
     * @return Monad|ShrinkableStart
     */
    public function range($from, $to = null);
}