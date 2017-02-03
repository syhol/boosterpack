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

interface Vector extends Indexed, Sortable, Setoid, Foldable, Monoid, Monad, JsonSerializable, Traversable
{
    /**
     * @return [Maybe, Vector]
     */
    public function pull();

    /**
     * @param mixed $item
     * @return Vector
     */
    public function shift($item);

    /**
     * @return [Maybe, Vector]
     */
    public function pop();

    /**
     * @param mixed $item
     * @return Vector
     */
    public function push($item);
}