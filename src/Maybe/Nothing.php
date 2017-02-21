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

    public function map(callable $function)
    {
        return $this;
    }

    public function bind(callable $function)
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

    public function orBind(callable $callable)
    {
        return $callable();
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