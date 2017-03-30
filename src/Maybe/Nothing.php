<?php

namespace Boosterpack\Maybe;

use Boosterpack\Contracts\Data\Maybe;
use Exception;

class Nothing implements Maybe
{
    public function toArray()
    {
        return [];
    }

    function jsonSerialize()
    {
        return null;
    }

    public function map(callable $function)
    {
        return $this;
    }

    public function flatMap(callable $function)
    {
        return $this;
    }

    public function orValue($default)
    {
        return new Just($default);
    }

    public function orElse(callable $callable)
    {
        return new Just($callable());
    }

    public function equals($other)
    {
        return $other instanceof Nothing;
    }

    public function expect($message)
    {
        throw new \UnexpectedValueException($message);
    }
}