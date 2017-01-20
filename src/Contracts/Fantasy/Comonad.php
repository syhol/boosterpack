<?php

interface Comonad extends Functor
{
    public function extract();
}