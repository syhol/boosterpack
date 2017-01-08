<?php

interface Indexed extends ArrayAccess
{
    public function elementAt($index);
    public function removeAt($index);
    public function has($index);
    public function mapAt($index, callable $callable);
    public function indices($value = null);
    public function indexOf($value);
    public function lastIndexOf($value);
    public function findIndex(callable $callable);
    public function findLastIndex(callable $callable);
    public function findIndices(callable $callable);
    public function pairs();
    public static function unPairs($pairs);
}