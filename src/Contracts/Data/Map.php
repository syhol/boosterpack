<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Fantasy\Foldable;
use Boosterpack\Contracts\Fantasy\Monoid;
use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Indexed;
use Boosterpack\Contracts\Sortable;
use JsonSerializable;

interface Map extends Indexed, Sortable, Foldable, Monoid, Monad, JsonSerializable
{
    public function set($index, $value);
    public function merge($map, ...$maps);
    public function keys();
    public function values();
    public function putIfAbsent($index, $value);
    public function mapKeys(callable $callable); // ?
    public static function combine($indices, $values);
    public static function fromKeys($indices, $value);
}