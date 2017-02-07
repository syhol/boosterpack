<?php

namespace Boosterpack\Contracts;

interface Sortable
{
    /**
     * @param callable|null $callable
     * @return static
     */
    public function sort(callable $callable = null);

    /**
     * @param callable|null $callable
     * @return static
     */
    public function reverse(callable $callable = null);
}