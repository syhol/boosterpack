<?php

namespace Boosterpack;

use Boosterpack\Contracts\Maybe;
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

/**
 * @param string $operator
 * @param array ...$params
 * @return callable
 */
function operator($operator, ...$params) {
    $functions = [
        'instanceof' => function($a, $b) { return $a instanceof $b; },
        '!'   => function($a)     { return ! $a;      },
        '*'   => function($a, $b) { return $a *   $b; },
        '/'   => function($a, $b) { return $a /   $b; },
        '%'   => function($a, $b) { return $a %   $b; },
        '+'   => function($a, $b) { return $a +   $b; },
        '-'   => function($a, $b) { return $a -   $b; },
        '.'   => function($a, $b) { return $a .   $b; },
        '<<'  => function($a, $b) { return $a <<  $b; },
        '>>'  => function($a, $b) { return $a >>  $b; },
        '<'   => function($a, $b) { return $a <   $b; },
        '<='  => function($a, $b) { return $a <=  $b; },
        '>'   => function($a, $b) { return $a >   $b; },
        '>='  => function($a, $b) { return $a >=  $b; },
        '=='  => function($a, $b) { return $a ==  $b; },
        '!='  => function($a, $b) { return $a !=  $b; },
        '===' => function($a, $b) { return $a === $b; },
        '!==' => function($a, $b) { return $a !== $b; },
        '&'   => function($a, $b) { return $a &   $b; },
        '^'   => function($a, $b) { return $a ^   $b; },
        '|'   => function($a, $b) { return $a |   $b; },
        '&&'  => function($a, $b) { return $a &&  $b; },
        '||'  => function($a, $b) { return $a ||  $b; },
        '**'  => function($a, $b) { return $a **  $b; },
        '<=>' => function($a, $b) {
            return $a == $b ? 0 : ($a < $b ? -1 : 1);
        },
    ];

    if (!isset($functions[$operator])) {
        throw new \InvalidArgumentException("Unknown operator \"$operator\"");
    }
    return curry($functions[$operator], $params);
}