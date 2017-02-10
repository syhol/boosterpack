<?php

namespace Boosterpack\Result;

use Boosterpack\Contracts\Data\Ok;
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
        return $this->value;
    }

    public function map(callable $function)
    {
        return $this;
    }

    public function orValue($default)
    {
        return new Ok($default);
    }

    public function andValue($default)
    {
        return $this;
    }

    public function mapError(callable $callable)
    {
        return $callable($this->value);
    }

    public function bind(callable $function)
    {
        return $this;
    }

    public function equals($other)
    {
        return $other instanceof Nothing;
    }
    public function throwIt()
    {
        throw $this->value;
    }
}