<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Data\Vector;

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

    /**
     * @param $count
     * @return self
     */
    public function drop($count);

    /**
     * @param $condition
     * @return self
     */
    public function dropWhile($condition);

    /**
     * @param $count
     * @return Vector
     */
    public function take($count);

    /**
     * @param $condition
     * @return Vector
     */
    public function takeWhile($condition);
}