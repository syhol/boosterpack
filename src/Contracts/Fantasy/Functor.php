<?php

interface Functor
{
    /**
     * @param callable $function
     *
     * @return self
     */
    public function map(callable $function);
}
