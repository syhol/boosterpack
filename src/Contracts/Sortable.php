<?php

namespace Boosterpack\Contracts;

interface Sortable
{
    /**
     * @param callable|null $callable
     * @return self
     */
    public function sort(callable $callable = null);
}