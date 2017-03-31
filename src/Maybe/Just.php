<?php

namespace Boosterpack\Maybe;

use Boosterpack\Contracts\Maybe;
use Boosterpack\Contracts\Fantasy\Comonad;

class Just implements Maybe, Comonad
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function toArray()
    {
        return [$this->value];
    }

    function jsonSerialize()
    {
        return $this->value;
    }

    public function extract()
    {
        return $this->value;
    }

    public function extend(callable $extender)
    {
        return new Just($extender($this));
    }

    public function map(callable $function)
    {
        return new Just($function($this->value));
    }

    public function orValue($default)
    {
        return $this;
    }

    public function orElse(callable $callable)
    {
        return $this;
    }

    public function flatMap(callable $callable)
    {
        return $callable($this->value);
    }

    public function equals($other)
    {
        return $other instanceof Just && $other->extract() === $this->value;
    }

    public function expect($message)
    {
        return $this->value;
    }
}
