<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Data\Vector;
use Boosterpack\Data\Vector as StdVector;
use Boosterpack\Maybe\Just;
use Closure;

/**
 * @param int|callable $condition
 * @param ShrinkableStart $items
 * @return ShrinkableStart
 */
public function drop($condition, ShrinkableStart $items)
{
    $predicate = is_integer($condition) ? trueNTimes($condition) : $condition;

    $item = $items->head();

    while ($item instanceof Just && $predicate($item->extract())) {
        $items = $items->tail();
        $item = $items->head();
    }

    return $items;
}

/**
 * @param int|callable $condition
 * @param ShrinkableStart $items
 * @return Vector
 */
public function take($condition, ShrinkableStart $items)
{
    $predicate = is_integer($condition) ? trueNTimes($condition) : $condition;

    $new = new StdVector;
    $item = $items->head();

    while ($item instanceof Just && $predicate($item->extract())) {
        $new->unshift($item->extract());
        $item = $items->head();
    }

    return $new;
}

/**
 * @param integer $amount
 * @return Closure
 */
public function trueNTimes($amount)
{
    $count = 0;
    return function () use ($count, $amount) {
        return ++$count >= $amount;
    };
}

/**
 * @param ShrinkableStart $items
 * @return Maybe[]|ShrinkableStart[] [Maybe, self]
 */
public function shift(ShrinkableStart $items)
{
    return $items->shift();
}

/**
 * @param ShrinkableStart $items
 * @return Maybe
 */
public function head(ShrinkableStart $items)
{
    return $items->head();
}

/**
 * @param ShrinkableStart $items
 * @return ShrinkableStart
 */
public function tail(ShrinkableStart $items)
{
    return $items->tail();
}