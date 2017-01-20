<?php

interface Monad extends Functor
{
    /**
     * @param callable $function
     *
     * @return self
     */
    public function bind(callable $function);
}