<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;

interface ShrinkableStart
{
    /**
     * @return Maybe[]|self[] [Maybe, self]
     */
    public function shift();

    /**
     * @return Maybe
     */
    public function head();

    /**
     * @return self
     */
    public function tail();
}