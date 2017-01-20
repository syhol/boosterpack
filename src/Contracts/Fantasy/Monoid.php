<?php

interface Monoid extends Semigroup
{
    /**
     * @return Monoid
     */
    public static function fromEmpty();

    /**
     * @return Monoid
     */
    public function getEmpty();
}
