<?php

namespace Boosterpack\Contracts\Resizable;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Data\Vector;
use Boosterpack\Maybe\Just;
use Closure;

/**
 * @param int|callable $condition
 * @param ShrinkableStart $items
 * @return ShrinkableStart
 */
function drop($condition, ShrinkableStart $items)
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
function take($condition, ShrinkableStart $items)
{
    $predicate = is_integer($condition) ? trueNTimes($condition) : $condition;

    $new = new Vector;
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
function trueNTimes($amount)
{
    $count = 0;
    return function () use ($count, $amount) {
        return ++$count >= $amount;
    };
}

/**
 * @param ShrinkableEnd $items
 * @return Maybe[]|ShrinkableEnd[] [Maybe, self]
 */
function pop(ShrinkableEnd $items)
{
    return $items->pop();
}

/**
 * @param ShrinkableStart $items
 * @return Maybe[]|ShrinkableStart[] [Maybe, self]
 * @return Maybe[]|ShrinkableStart[] [Maybe, self]
 */
function shift(ShrinkableStart $items)
{
    return $items->shift();
}

/**
 * @param ShrinkableStart $items
 * @return Maybe
 */
function head(ShrinkableStart $items)
{
    return $items->head();
}

/**
 * @param ShrinkableStart $items
 * @return ShrinkableStart
 */
function tail(ShrinkableStart $items)
{
    return $items->tail();
}