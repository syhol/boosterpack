<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Data\Vector;

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

    /**
     * @param $count
     * @return self
     */
    public function dropEnd($count);

    /**
     * @param $condition
     * @return self
     */
    public function dropEndWhile($condition);

    /**
     * @param $count
     * @return Vector
     */
    public function takeEnd($count);

    /**
     * @param $condition
     * @return Vector
     */
    public function takeEndWhile($condition);
}

