<?php

namespace Boosterpack\Contracts;

use ArrayAccess;
use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Data\Vector;

interface Indexed extends ArrayAccess
{
    /**
     * @param mixed $index
     * @return Maybe
     */
    public function elementAt($index);

    /**
     * @param mixed $index
     * @param callable $callable
     * @return self
     */
    public function mapAt($index, callable $callable);

    /**
     * @param mixed $value
     * @return Vector
     */
    public function indicesOf($value);

    /**
     * @param callable $callable
     * @return Vector
     */
    public function findIndices(callable $callable);

    /**
     * @return Vector
     */
    public function keys();

    /**
     * @return Vector
     */
    public function values();

    /**
     * @return Vector
     */
    public function pairs();

    /**
     * @param $pairs
     * @return Indexed
     */
    public static function unPairs($pairs);
}
