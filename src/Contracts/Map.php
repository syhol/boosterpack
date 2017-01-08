<?php

interface Map extends Set, Countable, Indexed, NumberContainer, Sortable, Traversable
{
    public function set($index, $value);
    public function merge($map, ...$maps);
    public function keys();
    public function values();
    public function putIfAbsent($index, $value);
    public function mapKeys(callable $callable);
    public static function combine($indices, $values);
    public static function fromKeys($indices, $value);
}