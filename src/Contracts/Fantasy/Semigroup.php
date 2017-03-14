<?php

namespace Boosterpack\Contracts\Fantasy;

interface Semigroup
{
    /**
     * @param mixed $value
     * @return static
     */
    public function append($value);

    /**
     * @param mixed $value
     * @return static
     */
    public function prepend($value);
}
