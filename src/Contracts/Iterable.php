<?php

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Fantasy\Monad;
use Traversable;

interface Iterable extends Monad, Traversable
{
    /**
     * @param $index
     * @return Maybe
     */
    public function elementAt($index);

    /**
     * @return Maybe
     */
    public function first();

    /**
     * @param int $amount
     * @return static
     */
    public function drop($amount);

    /**
     * @param int $amount
     * @return static
     */
    public function take($amount);

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

    /**
     * @param callable $predicate
     * @return static
     */
    public function filter(callable $predicate);
}