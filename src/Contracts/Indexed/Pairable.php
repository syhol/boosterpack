<?php

namespace Boosterpack\Contracts\Indexed;

use Boosterpack\Contracts\Data\Vector;

interface Pairable extends HasKeys, HasValues
{
    /**
     * @return Vector
     */
    public function pairs();

    /**
     * @param $pairs
     * @return static
     */
    public static function unPairs($pairs);
}