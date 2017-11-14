<?php

namespace Boosterpack\Contracts\Data;

interface Table extends Vector
{
    public function column($index);
    public function mappedColumn($keyIndex, $valueIndex);
    public function withColumns($indices);
    public function withoutColumns($indices);
    public function where($index, $value);
    public function whereNot($index, $value);
    public function whereIn($index, $values);
    public function groupBy($index);
    public function sortBy($index);
}