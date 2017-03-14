<?php

namespace Boosterpack;

use Boosterpack\Contracts\Data\Maybe;
use Boosterpack\Contracts\Fantasy\Comonad;
use Boosterpack\Maybe\Just;
use Boosterpack\Maybe\Nothing;
use Closure;

/**
 * @param mixed $item
 * @return mixed
 */
function id($item) {
    return $item;
}

/**
 * @param mixed $item
 * @return Closure
 */
function constant($item) {
    return function() use ($item) { return $item; };
}

/**
 * @return Closure
 */
function noop() {
    return function() {};
}

/**
 * @param mixed $value
 * @return Maybe
 */
function maybe($value) {
    return is_null($value) ? new Nothing() : new Just($value);
}

/**
 * @param $value
 * @param $default
 * @return mixed
 */
function extract($value, $default = null) {
    return $value instanceof Comonad ? $value->extract() : $default ;
}
