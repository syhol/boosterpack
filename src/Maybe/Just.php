<?php

namespace Boosterpack\Maybe;

use Boosterpack\Contracts\Data\Maybe;

class Just implements Maybe
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

    public function bind(callable $function)
    {
        return $function($this->value);
    }
}