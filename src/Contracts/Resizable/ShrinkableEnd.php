<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Data\Vector;

interface ShrinkableEnd
{
    /**
     * @return Maybe[]|static[] [Maybe, static]
     */
    public function pop();

    /**
     * @return static
     */
    public function init();

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

