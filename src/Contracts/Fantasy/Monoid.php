<?php

namespace Boosterpack\Contracts\Fantasy;

interface Monoid extends Semigroup
{
    /**
     * @return static
     */
    public static function fromEmpty();

    /**
     * @return static
     */
    public function getEmpty();
}
