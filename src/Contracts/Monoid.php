<?php

namespace Boosterpack\Contracts\Fantasy;

interface Monoid
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

    /**
     * @return static
     */
    public static function fromEmpty();

    /**
     * @return static
     */
    public function getEmpty();
}
