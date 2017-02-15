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
    public function head();

    /**
     * @return static
     */
    public function tail();

    /**
     * @param $count
     * @return static
     */
    public function drop($count);

    /**
     * @param $count
     * @return Vector
     */
    public function take($count);
}