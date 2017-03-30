<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 30/03/17
 * Time: 12:41
 */

namespace Boosterpack\Contracts;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Fantasy\Foldable;

interface FiniteIterable extends Iterable, Foldable
{
    /**
     * @return Maybe
     */
    public function last();

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
     * @return bool
     */
    public function join();
}