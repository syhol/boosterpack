<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;
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