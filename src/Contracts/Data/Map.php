<?php

namespace Boosterpack\Contracts\Data;

use Boosterpack\Contracts\Fantasy\Foldable;
use Boosterpack\Contracts\Fantasy\Monoid;
use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Fantasy\Setoid;
use Boosterpack\Contracts\Indexed;
use Boosterpack\Contracts\Sortable;
use JsonSerializable;
use Traversable;

interface Map extends Indexed, Sortable, Setoid, Foldable, Monoid, Monad, JsonSerializable, Traversable
{
    /**
     * @param $index
     * @param $value
     * @return self
     */
    public function setIfAbsent($index, $value);

    /**
     * @param $index
     * @param $value
     * @return self
     */
    public function set($index, $value); // Indexed

    public function mapKeys(callable $callable);
    public function mapValues(callable $callable);
}