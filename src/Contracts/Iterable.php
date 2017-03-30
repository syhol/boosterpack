<?php

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Fantasy\Monad;
use Boosterpack\Contracts\Resizable\ShrinkableStart;
use Traversable;

interface Iterable extends Monad, Traversable, ShrinkableStart
{
    /**
     * @param $index
     * @return Maybe
     */
    public function elementAt($index);

    /**
     * @param callable $predicate
     * @return static
     */
    public function filter(callable $predicate);

    /**
     * @param callable $predicate
     * @return static
     */
    public function dropWhile(callable $predicate);

    /**
     * @param callable $predicate
     * @return static
     */
    public function takeWhile(callable $predicate);
}