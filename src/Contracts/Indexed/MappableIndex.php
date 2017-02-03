<?php

namespace Boosterpack\Contracts\Indexed;


interface MappableIndex
{
    /**
     * @param mixed $index
     * @param callable $callable
     * @return static
     */
    public function mapAt($index, callable $callable);

    /**
     * @param callable $callable
     * @return static
     */
    public function mapValues(callable $callable);

    /**
     * @param callable $callable
     * @return static
     */
    public function mapKeys(callable $callable);
}