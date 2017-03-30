<?php

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Fantasy\Foldable;
use Boosterpack\Contracts\Resizable\ShrinkableEnd;

interface FiniteIterable extends Iterable, Foldable, ShrinkableEnd
{
    /**
     * @param callable $predicate
     * @return Maybe
     */
    public function findFirst(callable $predicate);

    /**
     * @param callable $predicate
     * @return Maybe
     */
    public function findLast(callable $predicate);

    /**
     * @param callable $predicate
     * @return static
     */
    public function dropEndWhile(callable $predicate);

    /**
     * @param callable $predicate
     * @return static
     */
    public function takeEndWhile(callable $predicate);
}