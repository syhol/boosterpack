<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Data\Vector;

interface ShrinkableStart
{
    /**
     * @return Maybe[]|static[] [Maybe, static]
     */
    public function shift();

    /**
     * @return Maybe
     */
    public function first();

    /**
     * @return static
     */
    public function tail();

    /**
     * @param int $amount
     * @return static
     */
    public function drop($amount);

    /**
     * @param int $amount
     * @return static
     */
    public function take($amount);
}