<?php

namespace Boosterpack\Extras\Contracts;

use Boosterpack\Contracts\Indexed;

interface IndexedExtras extends Indexed
{
    public function removeAt($index);
    public function has($index);
    public function indexOf($value);
    public function lastIndexOf($value);
    public function findIndex(callable $callable);
    public function findLastIndex(callable $callable);
}