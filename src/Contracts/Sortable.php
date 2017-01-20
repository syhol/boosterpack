<?php

namespace Boosterpack\Contracts;

interface Sortable
{
    public function sort(callable $callable = null);
}