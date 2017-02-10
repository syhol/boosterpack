<?php

namespace Boosterpack;

use Closure;
use Exception;
use ReflectionFunction;
use ReflectionMethod;

/**
 * @param callable $callable
 * @return Closure
 */
function flip(callable $callable) {
    return function(...$params) use ($callable) {
        return $callable(...array_reverse($params));
    };
}

/**
 * @param callable $callable
 * @return Closure
 */
function splat(callable $callable) {
    return function($params) use ($callable) {
        return $callable(...$params);
    };
}

/**
 * @param callable $callable
 * @return Closure
 */
function unsplat(callable $callable) {
    return function(...$params) use ($callable) {
        return $callable($params);
    };
}

/**
 * @param callable $callable1
 * @param callable $callable2
 * @return Closure
 */
function compose(callable $callable1, callable $callable2) {
    return function(...$params) use ($callable1, $callable2) {
        return $callable1($callable2(...$params));
    };
}

/**
 * @param callable $callable
 * @param array ...$params
 * @return mixed
 */
function invoke(callable $callable, ...$params) {
    return $callable(...$params);
}

/**
 * @param $method
 * @return Closure
 */
function method($method) {
    return function ($object) use($method) {
        return [$object, $method];
    };
}

/**
 * @param callable $callable
 * @return Closure
 */
function memoize(callable $callable) {
    return function(...$params) use ($callable) {
        static $cache = [];
        $key = md5(serialize($params));
        $cache[$key] = isset($cache[$key]) ? $cache[$key] : $callable(...$params);
        return $cache[$key];
    };
}

/**
 * @param callable $callable
 * @param null $default
 * @return Closure
 */
function once(callable $callable, $default = null) {
    return function(...$params) use ($callable, $default) {
        static $run = false;
        $result = $run ? $default : $callable(...$params) ;
        $run = true;
        return $result; 
    };
}

/**
 * @param $index
 * @param null $default
 * @return Closure
 */
function nthArg($index, $default = null) {
    return function(...$params) use ($index, $default) {
        return isset($params[$index]) ? $params[$index] : $default;
    };
}

/**
 * @param array ...$indices
 * @return Closure
 */
function nthArgs(...$indices) {
    return function(...$params) use ($indices) {
        return array_values(array_intersect_key($params, array_flip($indices)));
    };
}

/**
 * @param callable $callable
 * @return ReflectionFunction|ReflectionMethod
 * @throws Exception
 */
function reflectCallable(callable $callable) {
    $callable = (is_string($callable) && strpos($callable, '::') !== false)
        ? explode('::', $callable, 2)
        : $callable;

    if (is_array($callable) && count($callable) === 2) {
        list($class, $method) = array_values($callable);

        if (is_string($class) && ! method_exists($class, $method)) {
            $method = '__callStatic';
        }
        if (is_object($class) && ! method_exists($class, $method)) {
            $method = '__call';
        }
        return new ReflectionMethod($class, $method);
    } elseif ($callable instanceof Closure || is_string($callable)) {
        return new ReflectionFunction($callable);
    } elseif (is_object($callable) && method_exists($callable, '__invoke')) {
        return new ReflectionMethod($callable, '__invoke');
    }

    throw new Exception('Could not parse function');
}

/**
 * @param callable $callable
 * @return int
 */
function getArity(callable $callable) {
    return reflectCallable($callable)->getNumberOfRequiredParameters();
}

/**
 * @param callable $callable
 * @param $arity
 * @return Closure
 */
function setArity(callable $callable, $arity) {
    return function (...$params) use ($callable, $arity) {
        return $callable(...array_slice($params, 0, $arity));
    };
}

/**
 * @param callable $callable
 * @param null $count
 * @return callable|Closure
 */
function curry(callable $callable, $count = null) {
    $count = is_null($count) ? getArity($callable) : $count;
    return $count === 0 ? $callable : function (...$params) use($callable, $count) {
        $partial = invoke(partial(...$params), $callable); /** @type $partial callable */
        return count($params) >= $count ? $partial() : curry($partial, $count - count($params));
    };
}
