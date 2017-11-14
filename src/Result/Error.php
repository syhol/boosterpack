<?php

namespace Boosterpack\Result;

use Boosterpack\Contracts\Data\Result;

class Error implements Result
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
        throw $this->value;
    }

    public function map(callable $function)
    {
        return $this;
    }

    public function orValue($default)
    {
        return new Ok($default);
    }

    public function mapError(callable $callable)
    {
        return $callable($this->value);
    }

    public function flatMap(callable $function)
    {
        return $this;
    }

    public function flatMapError(callable $callable)
    {
        return $callable($this->value);
    }

    public function equals($other)
    {
        return $other instanceof self && $other->extract() === $this->value;
    }
}