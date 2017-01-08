<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 07/01/17
 * Time: 17:58
 */
interface Maybe
{
    public function extract();
    public function orValue($default);
    public function orElse(callable $callable);
    public function map(callable $callable);
    public function apply(Maybe $callable);
    public function bind(callable $callable);
}