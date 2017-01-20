<?php

interface Maybe extends Monad, Comonad
{
    public function orValue($default);
    public function orElse(callable $callable);
}