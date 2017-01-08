<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 07/01/17
 * Time: 23:44
 */
interface Sortable
{
    public function sort(callable $callable = null);
}