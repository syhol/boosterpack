<?php

namespace Boosterpack\Extras\Contracts;

interface IndexedExtras
{
    public function removeAt($index);
    public function hasKey($index);
    public function firstKeyOf($value);
    public function lastKeyOf($value);
    public function findFirstKey(callable $callable);
    public function findLastKey(callable $callable);
}