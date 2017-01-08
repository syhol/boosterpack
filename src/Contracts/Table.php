<?php

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 07/01/17
 * Time: 18:00
 */
interface Table extends Vector
{
    public function column($index);
    public function withColumns($indices);
    public function withoutColumns($indices);
    public function where($index, $value);
    public function whereIn($index, $values);
    public function groupBy($index);
}