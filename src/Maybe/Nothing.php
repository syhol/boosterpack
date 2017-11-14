<?php

namespace Boosterpack\Maybe;

use Boosterpack\Contracts\Data\Maybe;
use UnexpectedValueException;

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

    /**
     * @return mixed
     */
    public function extract()
    {
        throw new UnexpectedValueException();
    }
}