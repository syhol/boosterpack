<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 07/01/17
 * Time: 18:00
 */
interface Map extends Set, Countable, Indexed, NumberContainer, Sortable
{
    public static function combine($indices, $values);
}