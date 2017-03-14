<?php

namespace Boosterpack\Result;

use Boosterpack\Contracts\Data\Result;

class Ok implements Result
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

    public function extract()
    {
        return $this->value;
    }

    public function map(callable $function)
    {
        return new Ok($function($this->value));
    }

    public function orValue($default)
    {
        return $this;
    }

    public function flatMap(callable $function)
    {
        return $function($this->value);
    }

    public function flatMapError(callable $callable)
    {
        return $this;
    }

    public function mapError(callable $callable)
    {
        return $this;
    }

    public function equals($other)
    {
        return $other instanceof self && $other->extract() === $this->value;
    }

    public function throwIt()
    {
        return $this;
    }
}