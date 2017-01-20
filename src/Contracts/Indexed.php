<?php

namespace Boosterpack\Contracts;

use ArrayAccess;

interface Indexed extends ArrayAccess
{
    public function elementAt($index);
    public function removeAt($index); // ? may not allow removing items from an index
    public function has($index);
    public function mapAt($index, callable $callable);
    public function indexOf($value);
    public function lastIndexOf($value);
    public function indicesOf($value);
    public function findIndex(callable $callable);
    public function findLastIndex(callable $callable);
    public function findIndices(callable $callable);
    public function pairs();
    public static function unPairs($pairs);
}
