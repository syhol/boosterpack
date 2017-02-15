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
    public function end();

    /**
     * @param $count
     * @return static
     */
    public function dropEnd($count);

    /**
     * @param $count
     * @return Vector
     */
    public function takeEnd($count);

}

