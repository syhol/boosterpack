<?php

namespace Boosterpack;

use Closure;

/**
 * @param $item
 * @return mixed
 */
function id($item) {
    return $item;
}

/**
 * @param $item
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