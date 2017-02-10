<?php

namespace Boosterpack\Result;

use Boosterpack\Contracts\Data\Result;
use Throwable;

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

    public function andValue($default)
    {
        return new Ok($default);
    }

    public function bind(callable $function)
    {
        return $function($this->value);
    }

    public function equals($other)
    {
        return $other instanceof Just && $other->extract() === $this->value;
    }

    public function mapError(callable $callable)
    {
        // TODO: Implement mapError() method.
    }

    public function throwIt()
    {
        return $this;
    }
}