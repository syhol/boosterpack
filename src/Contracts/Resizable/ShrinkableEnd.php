<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;

interface ShrinkableEnd
{
    /**
     * @return Maybe[]|self[] [Maybe, self]
     */
    public function pop();

    /**
     * @return self
     */
    public function init();

    /**
     * @return Maybe
     */
    public function end();
}

