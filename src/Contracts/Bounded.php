<?php

namespace Boosterpack\Contracts;

interface Bounded
{
    /**
     * @return static
     */
    public function minBound();

    /**
     * @return static
     */
    public function maxBound();
}